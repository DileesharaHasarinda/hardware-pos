<x-layouts.admin>
    <x-slot name="title">Edit Customer | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Customer</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Customer</h3>
            <p class="mt-1 text-sm text-slate-500">Update customer details.</p>
        </div>

        <form method="POST" action="{{ route('admin.customers.update', $customer) }}">
            @csrf
            @method('PUT')

            @include('admin.customers._form', [
            'customer' => $customer,
            'customerGroups' => $customerGroups,
            'buttonText' => 'Update Customer',
            ])
        </form>
    </div>
</x-layouts.admin>