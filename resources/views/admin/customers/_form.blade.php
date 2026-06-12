@php
$customer = $customer ?? null;
@endphp

<div x-data="{ showAdvanced: false }" class="space-y-8">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div>
            <label for="code" class="mb-2 block text-sm font-medium text-slate-700">
                Customer Code <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="code"
                name="code"
                value="{{ old('code', $customer->code ?? '') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm uppercase shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                required>
            @error('code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                Customer Name <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $customer->name ?? '') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                required>
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="mobile" class="mb-2 block text-sm font-medium text-slate-700">Mobile</label>
            <input
                type="text"
                id="mobile"
                name="mobile"
                value="{{ old('mobile', $customer->mobile ?? '') }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            @error('mobile')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_group_id" class="mb-2 block text-sm font-medium text-slate-700">Customer Group</label>
            <select
                id="customer_group_id"
                name="customer_group_id"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <option value="">-- Select Customer Group --</option>
                @foreach($customerGroups as $group)
                <option
                    value="{{ $group->id }}"
                    {{ (string) old('customer_group_id', $customer->customer_group_id ?? '') === (string) $group->id ? 'selected' : '' }}>
                    {{ $group->name }} ({{ $group->code }})
                </option>
                @endforeach
            </select>
            @error('customer_group_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="lg:col-span-2">
            <label for="address" class="mb-2 block text-sm font-medium text-slate-700">Address</label>
            <textarea
                id="address"
                name="address"
                rows="3"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('address', $customer->address ?? '') }}</textarea>
            @error('address')
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
                value="{{ old('credit_limit', $customer->credit_limit ?? 0) }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            @error('credit_limit')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Blocked</label>
            <label class="inline-flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_blocked"
                    value="1"
                    {{ old('is_blocked', $customer->is_blocked ?? false) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-sm font-medium text-slate-700">Blocked Customer</span>
            </label>
            @error('is_blocked')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sales" class="mb-2 block text-sm font-medium text-slate-700">Sales</label>
            <input
                type="number"
                step="0.01"
                min="0"
                id="sales"
                name="sales"
                value="{{ old('sales', $customer->sales ?? 0) }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            @error('sales')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sales_return" class="mb-2 block text-sm font-medium text-slate-700">Sales Return</label>
            <input
                type="number"
                step="0.01"
                min="0"
                id="sales_return"
                name="sales_return"
                value="{{ old('sales_return', $customer->sales_return ?? 0) }}"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
            @error('sales_return')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="lg:col-span-2">
            <label for="remark" class="mb-2 block text-sm font-medium text-slate-700">Remark</label>
            <textarea
                id="remark"
                name="remark"
                rows="4"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('remark', $customer->remark ?? '') }}</textarea>
            @error('remark')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-slate-50">
        <button
            type="button"
            @click="showAdvanced = !showAdvanced"
            class="flex w-full items-center justify-between px-5 py-4 text-left">
            <span class="text-sm font-semibold text-slate-800">Advanced Option</span>
            <svg :class="showAdvanced ? 'rotate-180' : ''" class="h-4 w-4 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="showAdvanced" x-transition class="border-t border-slate-200 px-5 py-5">
            <label class="inline-flex items-center gap-3">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $customer->is_active ?? true) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-sm font-medium text-slate-700">Active Customer</span>
            </label>
            @error('is_active')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button
            type="submit"
            class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $buttonText ?? 'Save Customer' }}
        </button>

        <a
            href="{{ route('admin.customers.index') }}"
            class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Cancel
        </a>
    </div>
</div>