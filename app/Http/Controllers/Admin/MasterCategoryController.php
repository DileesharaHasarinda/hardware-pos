<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterCategoryStoreRequest;
use App\Http\Requests\MasterCategoryUpdateRequest;
use App\Models\MasterCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $masterCategories = MasterCategory::query()
            ->withCount('subCategories')
            ->search($search)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.master-categories.index', compact('masterCategories', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.master-categories.create');
    }

    public function store(MasterCategoryStoreRequest $request): RedirectResponse
    {
        MasterCategory::create($request->validated());

        return redirect()
            ->route('admin.master-categories.index')
            ->with('success', 'Master category created successfully.');
    }

    public function edit(Request $request, MasterCategory $masterCategory): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.master-categories.edit', compact('masterCategory'));
    }

    public function update(MasterCategoryUpdateRequest $request, MasterCategory $masterCategory): RedirectResponse
    {
        $masterCategory->update($request->validated());

        return redirect()
            ->route('admin.master-categories.index')
            ->with('success', 'Master category updated successfully.');
    }

    public function destroy(Request $request, MasterCategory $masterCategory): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        if ($masterCategory->subCategories()->exists()) {
            return redirect()
                ->route('admin.master-categories.index')
                ->with('error', 'This master category has sub categories. Delete them first.');
        }

        $masterCategory->delete();

        return redirect()
            ->route('admin.master-categories.index')
            ->with('success', 'Master category deleted successfully.');
    }

    public function quickStore(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:master_categories,name'],
            'code' => ['required', 'string', 'max:50', 'unique:master_categories,code'],
        ]);

        $masterCategory = MasterCategory::create([
            'name' => $validated['name'],
            'code' => strtoupper(trim($validated['code'])),
            'is_active' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Master category created successfully.')
            ->with('new_master_category_id', $masterCategory->id);
    }
}
