<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeStoreRequest;
use App\Http\Requests\SizeUpdateRequest;
use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        $search = trim((string) $request->get('search'));

        $sizes = Size::query()
            ->search($search)
            ->orderByDesc('is_default')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.sizes.index', compact('sizes', 'search'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.sizes.create');
    }

    public function store(SizeStoreRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();

            if (($data['is_default'] ?? false) === true) {
                Size::query()->update(['is_default' => false]);
            }

            Size::create($data);
        });

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size created successfully.');
    }

    public function edit(Request $request, Size $size): View
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        return view('admin.sizes.edit', compact('size'));
    }

    public function update(SizeUpdateRequest $request, Size $size): RedirectResponse
    {
        DB::transaction(function () use ($request, $size): void {
            $data = $request->validated();

            if (($data['is_default'] ?? false) === true) {
                Size::query()
                    ->whereKeyNot($size->id)
                    ->update(['is_default' => false]);
            }

            $size->update($data);
        });

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size updated successfully.');
    }

    public function destroy(Request $request, Size $size): RedirectResponse
    {
        abort_unless($request->user()?->can('master-details.manage'), 403);

        if ($size->is_default) {
            return redirect()
                ->route('admin.sizes.index')
                ->with('error', 'Default size cannot be deleted. Change the default first.');
        }

        $size->delete();

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully.');
    }
}