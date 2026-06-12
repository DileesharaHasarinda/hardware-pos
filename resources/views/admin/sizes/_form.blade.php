@php
    $size = $size ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
            Size Name <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $size->name ?? '') }}"
            placeholder="Example: 200ml, 1L, 1Kg"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-3">
            <input
                type="checkbox"
                name="is_default"
                value="1"
                {{ old('is_default', $size->is_default ?? false) ? 'checked' : '' }}
                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
            >
            <span class="text-sm font-medium text-slate-700">Set as Default Size</span>
        </label>
        @error('is_default')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="inline-flex items-center gap-3">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $size->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
            >
            <span class="text-sm font-medium text-slate-700">Active</span>
        </label>
        @error('is_active')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button
        type="submit"
        class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
    >
        {{ $buttonText ?? 'Save Size' }}
    </button>

    <a
        href="{{ route('admin.sizes.index') }}"
        class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
    >
        Cancel
    </a>
</div>