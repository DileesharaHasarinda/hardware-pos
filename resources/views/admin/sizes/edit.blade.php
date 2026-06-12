<x-layouts.admin>
    <x-slot name="title">Edit Size | Hardware POS</x-slot>
    <x-slot name="pageTitle">Edit Size</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">Edit Size</h3>
            <p class="mt-1 text-sm text-slate-500">Update the selected size record.</p>
        </div>

        <form method="POST" action="{{ route('admin.sizes.update', $size) }}">
            @csrf
            @method('PUT')

            @include('admin.sizes._form', [
                'size' => $size,
                'buttonText' => 'Update Size',
            ])
        </form>
    </div>
</x-layouts.admin>