<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $masterCategories = Category::query()
            ->masters()
            ->search($search)
            ->orderBy('name')
            ->paginate(10, ['*'], 'masters_page')
            ->withQueryString();

        $subCategories = Category::query()
            ->childrenOnly()
            ->with('parent')
            ->search($search)
            ->orderBy('name')
            ->paginate(10, ['*'], 'subs_page')
            ->withQueryString();

        return view('admin.categories.index', compact(
            'masterCategories',
            'subCategories',
            'search'
        ));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $type = $request->get('type', 'master');

        $masterCategories = Category::query()
            ->masters()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.categories.create', compact('masterCategories', 'type'));
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Request $request, Category $category): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $masterCategories = Category::query()
            ->masters()
            ->whereKeyNot($category->id)
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return view('admin.categories.edit', compact('category', 'masterCategories'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        if ($category->children()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'This master category has child categories. Delete child categories first.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
