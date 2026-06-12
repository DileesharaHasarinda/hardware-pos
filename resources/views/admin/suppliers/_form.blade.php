@php
    $supplier = $supplier ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Name <span class="text-red-500">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $supplier->name ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="mobile" class="mb-2 block text-sm font-medium text-slate-700">Mobile <span class="text-red-500">*</span></label>
        <input
            type="text"
            id="mobile"
            name="mobile"
            value="{{ old('mobile', $supplier->mobile ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
            required
        >
        @error('mobile')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="contact_person" class="mb-2 block text-sm font-medium text-slate-700">Contact Person</label>
        <input
            type="text"
            id="contact_person"
            name="contact_person"
            value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >
        @error('contact_person')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="contact_person_designation" class="mb-2 block text-sm font-medium text-slate-700">Contact Person Designation</label>
        <input
            type="text"
            id="contact_person_designation"
            name="contact_person_designation"
            value="{{ old('contact_person_designation', $supplier->contact_person_designation ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >
        @error('contact_person_designation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="credit_limit" class="mb-2 block text-sm font-medium text-slate-700">Credit Limit</label>
        <input
            type="number"
            step="0.01"
            min="0"
            id="credit_limit"
            name="credit_limit"
            value="{{ old('credit_limit', $supplier->credit_limit ?? 0) }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >
        @error('credit_limit')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="credit" class="mb-2 block text-sm font-medium text-slate-700">Credit</label>
        <input
            type="number"
            step="0.01"
            min="0"
            id="credit"
            name="credit"
            value="{{ old('credit', $supplier->credit ?? 0) }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >
        @error('credit')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label for="address" class="mb-2 block text-sm font-medium text-slate-700">Address</label>
        <textarea
            id="address"
            name="address"
            rows="3"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >{{ old('address', $supplier->address ?? '') }}</textarea>
        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label for="remark" class="mb-2 block text-sm font-medium text-slate-700">Remark</label>
        <textarea
            id="remark"
            name="remark"
            rows="4"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
        >{{ old('remark', $supplier->remark ?? '') }}</textarea>
        @error('remark')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label class="inline-flex items-center gap-3">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $supplier->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500"
            >
            <span class="text-sm font-medium text-slate-700">Active Supplier</span>
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
        {{ $buttonText ?? 'Save Supplier' }}
    </button>

    <a
        href="{{ route('admin.suppliers.index') }}"
        class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
    >
        Cancel
    </a>
</div>