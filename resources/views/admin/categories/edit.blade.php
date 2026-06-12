<x-layouts.admin>
    <x-slot name="title">Edit Category | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Category</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Category</h3>
            <p class="mt-1 text-sm text-slate-500">Update master category or category details.</p>
        </div>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')

            @include('admin.categories._form', [
                'category' => $category,
                'masterCategories' => $masterCategories,
                'buttonText' => 'Update Category',
            ])
        </form>
    </div>
</x-layouts.admin>