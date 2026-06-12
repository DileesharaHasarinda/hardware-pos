@php
$subCategory = $subCategory ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label class="mb-2 block text-sm font-medium text-slate-700">
            Master Category <span class="text-red-500">*</span>
        </label>

        <div
            x-data="{
                open: false,
                search: '',
                selectedId: '{{ old('master_category_id', $subCategory->master_category_id ?? '') }}',
                selectedLabel: '',
                options: [
                    @foreach($masterCategories as $masterCategory)
                        {
                            id: '{{ $masterCategory->id }}',
                            name: '{{ addslashes($masterCategory->name) }}',
                            code: '{{ addslashes($masterCategory->code) }}',
                            label: '{{ addslashes($masterCategory->name) }} ({{ addslashes($masterCategory->code) }})'
                        },
                    @endforeach
                ],
                init() {
                    const selected = this.options.find(option => option.id === this.selectedId);
                    this.selectedLabel = selected ? selected.label : '';
                },
                get filteredOptions() {
                    if (!this.search.trim()) {
                        return this.options;
                    }

                    return this.options.filter(option =>
                        option.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        option.code.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                selectOption(option) {
                    this.selectedId = option.id;
                    this.selectedLabel = option.label;
                    this.search = '';
                    this.open = false;
                }
            }"
            class="relative">
            <input type="hidden" name="master_category_id" :value="selectedId">

            <button
                type="button"
                @click="open = !open"
                class="flex w-full items-center justify-between rounded-xl border border-slate-300 bg-white px-4 py-3 text-left text-sm shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                :class="open ? 'border-blue-500 ring-2 ring-blue-100' : ''">
                <span class="truncate" :class="selectedLabel ? 'text-slate-900' : 'text-slate-400'">
                    <span x-text="selectedLabel || '-- Select Master Category --'"></span>
                </span>

                <svg
                    class="h-4 w-4 text-slate-500 transition-transform"
                    :class="open ? 'rotate-180' : ''"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div
                x-show="open"
                x-transition
                @click.away="open = false"
                class="absolute z-30 mt-2 w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
                style="display: none;">
                <div class="border-b border-slate-200 p-3">
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Search master category..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>

                <div class="max-h-64 overflow-y-auto py-2">
                    <template x-if="filteredOptions.length > 0">
                        <div>
                            <template x-for="option in filteredOptions" :key="option.id">
                                <button
                                    type="button"
                                    @click="selectOption(option)"
                                    class="flex w-full items-center justify-between px-4 py-3 text-left text-sm transition hover:bg-slate-50"
                                    :class="selectedId === option.id ? 'bg-blue-50 text-blue-700' : 'text-slate-700'">
                                    <span class="truncate" x-text="option.label"></span>

                                    <svg
                                        x-show="selectedId === option.id"
                                        class="h-4 w-4 shrink-0"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </template>

                    <template x-if="filteredOptions.length === 0">
                        <div class="px-4 py-6 text-center text-sm text-slate-500">
                            No master categories found.
                        </div>
                    </template>
                </div>
            </div>
        </div>

        @error('master_category_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
            Sub Category Name <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $subCategory->name ?? '') }}"
            placeholder="Example: Emulsion Paint, Switches"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required>
        @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="code" class="mb-2 block text-sm font-medium text-slate-700">
            Sub Category Code <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="code"
            name="code"
            value="{{ old('code', $subCategory->code ?? '') }}"
            placeholder="Example: EMP, SWT"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm uppercase shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required>
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
                {{ old('is_active', $subCategory->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <span class="text-sm font-medium text-slate-700">Active</span>
        </label>
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button
        type="submit"
        class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
        {{ $buttonText ?? 'Save Sub Category' }}
    </button>

    <a
        href="{{ route('admin.sub-categories.index') }}"
        class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
        Cancel
    </a>
</div>