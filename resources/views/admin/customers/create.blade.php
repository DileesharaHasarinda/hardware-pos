<x-layouts.admin>
    <x-slot name="title">Create Customer | Hardware POS</x-slot>
    <x-slot name="pageTitle">Create Customer</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">New Customer</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new customer to the system.</p>
        </div>

        <form method="POST" action="{{ route('admin.customers.store') }}">
            @csrf

            @include('admin.customers._form', [
            'customerGroups' => $customerGroups,
            'buttonText' => 'Save Customer',
            ])
        </form>
    </div>
</x-layouts.admin>