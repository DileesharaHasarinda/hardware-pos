<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('customers.view'), 403);

        $search = trim((string) $request->get('search'));

        $customers = Customer::query()
            ->with('customerGroup')
            ->search($search)
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('customers.create'), 403);

        $customerGroups = CustomerGroup::query()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.customers.create', compact('customerGroups'));
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit(Request $request, Customer $customer): View
    {
        abort_unless($request->user()?->can('customers.update'), 403);

        $customerGroups = CustomerGroup::query()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.customers.edit', compact('customer', 'customerGroups'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Request $request, Customer $customer): RedirectResponse
    {
        abort_unless($request->user()?->can('customers.delete'), 403);

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
