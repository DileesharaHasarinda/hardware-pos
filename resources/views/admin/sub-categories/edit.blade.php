<x-layouts.admin>
    <x-slot name="title">Edit Sub Category | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Sub Category</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Sub Category</h3>
            <p class="mt-1 text-sm text-slate-500">Update sub category details.</p>
        </div>

        <form method="POST" action="{{ route('admin.sub-categories.update', $subCategory) }}">
            @csrf
            @method('PUT')
            @include('admin.sub-categories._form', [
                'subCategory' => $subCategory,
                'masterCategories' => $masterCategories,
                'buttonText' => 'Update Sub Category'
            ])
        </form>
    </div>
</x-layouts.admin>