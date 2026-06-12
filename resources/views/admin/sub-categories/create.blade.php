<x-layouts.admin>
    <x-slot name="title">Create Sub Category | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Sub Category</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Sub Category</h3>
            <p class="mt-1 text-sm text-slate-500">Select a master category, then add the sub category.</p>
        </div>

        <form method="POST" action="{{ route('admin.sub-categories.store') }}">
            @csrf
            @include('admin.sub-categories._form', [
                'masterCategories' => $masterCategories,
                'buttonText' => 'Save Sub Category'
            ])
        </form>
    </div>
</x-layouts.admin>