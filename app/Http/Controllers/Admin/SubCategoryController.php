<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Models\MasterCategory;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $subCategories = SubCategory::query()
            ->with('masterCategory')
            ->search($search)
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.sub-categories.index', compact('subCategories', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $masterCategories = MasterCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.sub-categories.create', compact('masterCategories'));
    }

    public function store(SubCategoryStoreRequest $request): RedirectResponse
    {
        SubCategory::create($request->validated());

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub category created successfully.');
    }

    public function edit(Request $request, SubCategory $subCategory): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $masterCategories = MasterCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.sub-categories.edit', compact('subCategory', 'masterCategories'));
    }

    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory): RedirectResponse
    {
        $subCategory->update($request->validated());

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub category updated successfully.');
    }

    public function destroy(Request $request, SubCategory $subCategory): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $subCategory->delete();

        return redirect()
            ->route('admin.sub-categories.index')
            ->with('success', 'Sub category deleted successfully.');
    }
}