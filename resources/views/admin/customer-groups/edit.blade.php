<x-layouts.admin>
    <x-slot name="title">Edit Customer Group | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Customer Group</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Customer Group</h3>
            <p class="mt-1 text-sm text-slate-500">Update customer group details.</p>
        </div>

        <form method="POST" action="{{ route('admin.customer-groups.update', $customerGroup) }}">
            @csrf
            @method('PUT')
            @include('admin.customer-groups._form', [
            'customerGroup' => $customerGroup,
            'buttonText' => 'Update Customer Group'
            ])
        </form>
    </div>
</x-layouts.admin>