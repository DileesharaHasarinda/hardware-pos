<x-layouts.admin>
    <x-slot name="title">Edit Brand | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Brand</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Brand</h3>
            <p class="mt-1 text-sm text-slate-500">Update brand information.</p>
        </div>

        <form method="POST" action="{{ route('admin.brands.update', $brand) }}">
            @csrf
            @method('PUT')

            @include('admin.brands._form', [
                'brand' => $brand,
                'buttonText' => 'Update Brand',
            ])
        </form>
    </div>
</x-layouts.admin>