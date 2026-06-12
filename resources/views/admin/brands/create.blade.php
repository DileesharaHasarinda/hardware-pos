<x-layouts.admin>
    <x-slot name="title">Create Brand | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Brand</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Brand</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new brand to master details.</p>
        </div>

        <form method="POST" action="{{ route('admin.brands.store') }}">
            @csrf

            @include('admin.brands._form', [
                'buttonText' => 'Save Brand',
            ])
        </form>
    </div>
</x-layouts.admin>