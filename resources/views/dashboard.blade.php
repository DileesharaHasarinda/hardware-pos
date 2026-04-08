<x-layouts.admin>
    <x-slot name="title">Dashboard | Hardware POS</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Today's Sales</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-900">Rs. 0.00</h3>
                    </div>
                    <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-2.21 0-4 .895-4 2s1.79 2 4 2 4 .895 4 2-1.79 2-4 2m0-10v12"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Products</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-900">0</h3>
                    </div>
                    <div class="rounded-2xl bg-blue-100 p-3 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Low Stock Alerts</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-900">0</h3>
                    </div>
                    <div class="rounded-2xl bg-amber-100 p-3 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.29 3.86l-7 12.13A2 2 0 005.02 19h13.96a2 2 0 001.73-3.01l-7-12.13a2 2 0 00-3.46 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Customers</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-900">0</h3>
                    </div>
                    <div class="rounded-2xl bg-purple-100 p-3 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H11a4 4 0 00-4 4v2m10 0H7m8-10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
                        <p class="text-sm text-slate-500">Fast access to core modules</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @can('products.view')
                        <a href="{{ route('admin.products.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Products</h4>
                            <p class="mt-1 text-sm text-slate-500">Manage catalog, SKU, and barcode items.</p>
                        </a>
                    @endcan

                    @can('inventory.view')
                        <a href="{{ route('admin.inventory.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Inventory</h4>
                            <p class="mt-1 text-sm text-slate-500">Track stock balances and movements.</p>
                        </a>
                    @endcan

                    @can('purchases.view')
                        <a href="{{ route('admin.purchases.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Purchases</h4>
                            <p class="mt-1 text-sm text-slate-500">Handle suppliers and stock intake.</p>
                        </a>
                    @endcan

                    @can('sales.view')
                        <a href="{{ route('admin.sales.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Sales / POS</h4>
                            <p class="mt-1 text-sm text-slate-500">Open the cashier and billing workflows.</p>
                        </a>
                    @endcan

                    @can('reports.view')
                        <a href="{{ route('admin.reports.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Reports</h4>
                            <p class="mt-1 text-sm text-slate-500">Sales, stock, and operational insights.</p>
                        </a>
                    @endcan

                    @can('users.view')
                        <a href="{{ route('admin.users.index') }}" class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                            <h4 class="font-semibold text-slate-900">Users</h4>
                            <p class="mt-1 text-sm text-slate-500">Manage system access and staff roles.</p>
                        </a>
                    @endcan
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <div class="border-b border-slate-200 pb-4">
                    <h3 class="text-lg font-bold text-slate-900">System Status</h3>
                    <p class="text-sm text-slate-500">Current application overview</p>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
                        <span class="text-sm font-medium text-slate-600">Application</span>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Online</span>
                    </div>

                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
                        <span class="text-sm font-medium text-slate-600">Database</span>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Connected</span>
                    </div>

                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
                        <span class="text-sm font-medium text-slate-600">Redis Cache</span>
                        <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Active</span>
                    </div>

                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
                        <span class="text-sm font-medium text-slate-600">Logged User</span>
                        <span class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>