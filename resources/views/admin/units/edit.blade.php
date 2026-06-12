<x-layouts.admin>
    <x-slot name="title">Edit Unit | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Unit</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Unit</h3>
            <p class="mt-1 text-sm text-slate-500">Update unit details.</p>
        </div>

        <form method="POST" action="{{ route('admin.units.update', $unit) }}">
            @csrf
            @method('PUT')
            @include('admin.units._form', [
            'unit' => $unit,
            'buttonText' => 'Update Unit'
            ])
        </form>
    </div>
</x-layouts.admin>