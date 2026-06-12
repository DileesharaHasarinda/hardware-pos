<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerGroupStoreRequest;
use App\Http\Requests\CustomerGroupUpdateRequest;
use App\Models\CustomerGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $customerGroups = CustomerGroup::query()
            ->search($search)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.customer-groups.index', compact('customerGroups', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.customer-groups.create');
    }

    public function store(CustomerGroupStoreRequest $request): RedirectResponse
    {
        CustomerGroup::create($request->validated());

        return redirect()
            ->route('admin.customer-groups.index')
            ->with('success', 'Customer group created successfully.');
    }

    public function edit(Request $request, CustomerGroup $customerGroup): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.customer-groups.edit', compact('customerGroup'));
    }

    public function update(CustomerGroupUpdateRequest $request, CustomerGroup $customerGroup): RedirectResponse
    {
        $customerGroup->update($request->validated());

        return redirect()
            ->route('admin.customer-groups.index')
            ->with('success', 'Customer group updated successfully.');
    }

    public function destroy(Request $request, CustomerGroup $customerGroup): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        if ($customerGroup->customers()->exists()) {
            return redirect()
                ->route('admin.customer-groups.index')
                ->with('error', 'This customer group is already used by customers and cannot be deleted.');
        }

        $customerGroup->delete();

        return redirect()
            ->route('admin.customer-groups.index')
            ->with('success', 'Customer group deleted successfully.');
    }
}
