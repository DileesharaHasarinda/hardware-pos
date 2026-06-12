<x-layouts.admin>
    <x-slot name="title">
        {{ $type === 'sub' ? 'Create Sub Category' : 'Create Master Category' }} | Hardware POS
    </x-slot>
    <x-slot name="pageTitle">
        {{ $type === 'sub' ? 'Create Sub Category' : 'Create Master Category' }}
    </x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h3 class="text-lg font-bold text-slate-900">
                {{ $type === 'sub' ? 'New Sub Category' : 'New Master Category' }}
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                {{ $type === 'sub'
                    ? 'Create a category under an existing Master Category.'
                    : 'Create a top-level Master Category.' }}
            </p>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            @include('admin.categories._form', [
                'masterCategories' => $masterCategories,
                'buttonText' => $type === 'sub' ? 'Save Sub Category' : 'Save Master Category',
            ])
        </form>
    </div>
</x-layouts.admin>