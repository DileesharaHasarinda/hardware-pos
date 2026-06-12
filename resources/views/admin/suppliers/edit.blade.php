<x-layouts.admin>
    <x-slot name="title">Edit Supplier | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Supplier</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Supplier</h3>
            <p class="mt-1 text-sm text-slate-500">Update supplier information.</p>
        </div>

        <form method="POST" action="{{ route('admin.suppliers.update', $supplier) }}">
            @csrf
            @method('PUT')

            @include('admin.suppliers._form', [
                'supplier' => $supplier,
                'buttonText' => 'Update Supplier',
            ])
        </form>
    </div>
</x-layouts.admin>