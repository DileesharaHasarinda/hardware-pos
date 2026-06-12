<x-layouts.admin>
    <x-slot name="title">Suppliers | Hardware POS</x-slot>
    <x-slot name="pageTitle">Suppliers</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Supplier Management</h3>
                    <p class="mt-1 text-sm text-slate-500">Manage hardware suppliers, contact details, and credit settings.</p>
                </div>

                @can('suppliers.create')
                    <a
                        href="{{ route('admin.suppliers.create') }}"
                        class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >
                        Add Supplier
                    </a>
                @endcan
            </div>

            @if(session('success'))
                <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('admin.suppliers.index') }}" class="mt-6">
                <div class="flex flex-col gap-3 md:flex-row">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by name, mobile, contact person..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >
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
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Mobile</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Contact Person</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Credit Limit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Credit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($suppliers as $supplier)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">{{ $supplier->name }}</div>
                                    @if($supplier->address)
                                        <div class="mt-1 text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($supplier->address, 60) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $supplier->mobile }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-slate-800">{{ $supplier->contact_person ?: '-' }}</div>
                                    <div class="text-xs text-slate-500">{{ $supplier->contact_person_designation ?: '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ number_format((float) $supplier->credit_limit, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ number_format((float) $supplier->credit, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($supplier->is_active)
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('suppliers.update')
                                            <a
                                                href="{{ route('admin.suppliers.edit', $supplier) }}"
                                                class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50"
                                            >
                                                Edit
                                            </a>
                                        @endcan

                                        @can('suppliers.delete')
                                            <form method="POST" action="{{ route('admin.suppliers.destroy', $supplier) }}" onsubmit="return confirm('Delete this supplier?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50"
                                                >
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
                                    No suppliers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-6 py-4">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>