<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 transform overflow-y-auto border-r border-slate-200 bg-slate-950 text-slate-200 transition-transform duration-300 ease-in-out"
>
    <div class="flex h-20 items-center justify-between border-b border-slate-800 px-6">
        <div>
            <h1 class="text-xl font-bold tracking-wide text-white">Hardware POS</h1>
            <p class="text-xs text-slate-400">Industry Admin Panel</p>
        </div>

        <button
            class="rounded-lg p-2 text-slate-400 hover:bg-slate-800 hover:text-white lg:hidden"
            @click="sidebarOpen = false"
            type="button"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="px-4 py-6">
        <div class="mb-6 rounded-2xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-xs uppercase tracking-wider text-slate-400">Logged in as</p>
            <p class="mt-1 text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>

            @if(method_exists(auth()->user(), 'getRoleNames'))
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach(auth()->user()->getRoleNames() as $role)
                        <span class="rounded-full bg-emerald-500/15 px-2.5 py-1 text-[11px] font-medium text-emerald-300">
                            {{ ucfirst($role) }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <nav class="space-y-8">
            <div>
                <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Main</p>

                <div class="space-y-1">
                    @can('dashboard.view')
                        <a
                            href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l9-9 9 9M4.5 10.5V20a1 1 0 001 1H9v-6h6v6h3.5a1 1 0 001-1v-9.5"/>
                            </svg>
                            Dashboard
                        </a>
                    @endcan
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Operations</p>

                <div class="space-y-1">
                    @can('products.view')
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                            </svg>
                            Products
                        </a>
                    @endcan

                    @can('inventory.view')
                        <a
                            href="{{ route('admin.inventory.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.inventory.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M4 12h16M4 17h10"/>
                            </svg>
                            Inventory
                        </a>
                    @endcan

                    @can('purchases.view')
                        <a
                            href="{{ route('admin.purchases.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.purchases.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6M7 13l1.5 6m9-6l1.5 6M9 19h6"/>
                            </svg>
                            Purchases
                        </a>
                    @endcan

                    @can('sales.view')
                        <a
                            href="{{ route('admin.sales.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.sales.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-2.21 0-4 .895-4 2s1.79 2 4 2 4 .895 4 2-1.79 2-4 2m0-10v12m8-6a8 8 0 11-16 0 8 8 0 0116 0z"/>
                            </svg>
                            Sales / POS
                        </a>
                    @endcan

                    @can('reports.view')
                        <a
                            href="{{ route('admin.reports.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-6m4 6V7m4 10v-3M5 21h14"/>
                            </svg>
                            Reports
                        </a>
                    @endcan
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Administration</p>

                <div class="space-y-1">
                    @can('users.view')
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                                {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H11a4 4 0 00-4 4v2m10 0H7m8-10a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Users
                        </a>
                    @endcan
                </div>
            </div>
        </nav>
    </div>
</aside>