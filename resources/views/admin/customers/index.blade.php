<x-layouts.admin>
    <x-slot name="title">Customers | Hardware POS</x-slot>
    <x-slot name="pageTitle">Customers</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Customer Management</h3>
                    <p class="mt-1 text-sm text-slate-500">Manage customer records, credit, groups, and blocking status.</p>
                </div>

                @can('customers.create')
                <a
                    href="{{ route('admin.customers.create') }}"
                    class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Add Customer
                </a>
                @endcan
            </div>

            @if(session('success'))
            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
            @endif

            <form method="GET" action="{{ route('admin.customers.index') }}" class="mt-6">
                <div class="flex flex-col gap-3 md:flex-row">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by code, name, mobile, or customer group..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Code</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Mobile</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Group</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Credit Limit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Blocked</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $customer->code }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">{{ $customer->name }}</div>
                                @if($customer->address)
                                <div class="mt-1 text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($customer->address, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $customer->mobile ?: '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">
                                {{ $customer->customerGroup?->name ? $customer->customerGroup->name.' ('.$customer->customerGroup->code.')' : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ number_format((float) $customer->credit_limit, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($customer->is_blocked)
                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Blocked</span>
                                @else
                                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @can('customers.update')
                                    <a href="{{ route('admin.customers.edit', $customer) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                                        Edit
                                    </a>
                                    @endcan

                                    @can('customers.delete')
                                    <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                No customers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-6 py-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>