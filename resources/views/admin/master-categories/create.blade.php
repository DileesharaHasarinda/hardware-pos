<x-layouts.admin>
    <x-slot name="title">Create Master Category | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Master Category</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Master Category</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new master category.</p>
        </div>

        <form method="POST" action="{{ route('admin.master-categories.store') }}">
            @csrf
            @include('admin.master-categories._form', ['buttonText' => 'Save Master Category'])
        </form>
    </div>
</x-layouts.admin>