<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $units = Unit::query()
            ->search($search)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.units.index', compact('units', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.units.create');
    }

    public function store(UnitStoreRequest $request): RedirectResponse
    {
        Unit::create($request->validated());

        return redirect()
            ->route('admin.units.index')
            ->with('success', 'Unit created successfully.');
    }

    public function edit(Request $request, Unit $unit): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.units.edit', compact('unit'));
    }

    public function update(UnitUpdateRequest $request, Unit $unit): RedirectResponse
    {
        $unit->update($request->validated());

        return redirect()
            ->route('admin.units.index')
            ->with('success', 'Unit updated successfully.');
    }

    public function destroy(Request $request, Unit $unit): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $unit->delete();

        return redirect()
            ->route('admin.units.index')
            ->with('success', 'Unit deleted successfully.');
    }
}
