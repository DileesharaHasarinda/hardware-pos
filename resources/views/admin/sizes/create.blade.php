<x-layouts.admin>
    <x-slot name="title">Create Size | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Size</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Size</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new size to master details.</p>
        </div>

        <form method="POST" action="{{ route('admin.sizes.store') }}">
            @csrf

            @include('admin.sizes._form', [
                'buttonText' => 'Save Size',
            ])
        </form>
    </div>
</x-layouts.admin>