@php
    $category = $category ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div>
        <label for="parent_id" class="mb-2 block text-sm font-medium text-slate-700">
            Master Category
        </label>
        <select
            id="parent_id"
            name="parent_id"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >
            <option value="">-- This is a Master Category --</option>
            @foreach($masterCategories as $masterCategory)
                <option
                    value="{{ $masterCategory->id }}"
                    {{ (string) old('parent_id', $category->parent_id ?? request('type') === 'sub' ? old('parent_id', $category->parent_id ?? '') : ($category->parent_id ?? '')) === (string) $masterCategory->id ? 'selected' : '' }}
                >
                    {{ $masterCategory->name }} ({{ $masterCategory->code }})
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div></div>

    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
            {{ old('parent_id', $category->parent_id ?? request('parent_id')) ? 'Sub Category Name' : 'Master Category Name' }}
            <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $category->name ?? '') }}"
            placeholder="Example: Paint / Emulsion Paint"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="code" class="mb-2 block text-sm font-medium text-slate-700">
            {{ old('parent_id', $category->parent_id ?? request('parent_id')) ? 'Sub Category Code' : 'Master Category Code' }}
            <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="code"
            name="code"
            value="{{ old('code', $category->code ?? '') }}"
            placeholder="Example: PNT / EMP"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm uppercase shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required
        >
        @error('code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label class="inline-flex items-center gap-3">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
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
        {{ $buttonText ?? 'Save Category' }}
    </button>

    <a
        href="{{ route('admin.categories.index') }}"
        class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
    >
        Cancel
    </a>
</div>