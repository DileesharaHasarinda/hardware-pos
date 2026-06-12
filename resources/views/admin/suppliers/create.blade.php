<x-layouts.admin>
    <x-slot name="title">Create Supplier | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Supplier</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Supplier</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new supplier record to the system.</p>
        </div>

        <form method="POST" action="{{ route('admin.suppliers.store') }}">
            @csrf

            @include('admin.suppliers._form', [
                'buttonText' => 'Save Supplier',
            ])
        </form>
    </div>
</x-layouts.admin>