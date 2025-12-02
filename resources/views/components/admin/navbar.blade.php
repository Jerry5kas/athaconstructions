<nav class="w-full border-b border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        {{-- Left: Page title / breadcrumb --}}
        <div class="flex items-center space-x-3">
            <span class="text-xs uppercase tracking-wide text-gray-400">Admin</span>
            <span class="text-gray-400">/</span>
            <h1 class="text-sm sm:text-base font-semibold text-gray-800 capitalize">
                @yield('page-title', $pageTitle ?? 'Dashboard')
            </h1>
        </div>

        {{-- Right: User info / logout --}}
        <div class="flex items-center space-x-4">
            <div class="hidden sm:flex flex-col items-end">
                <span class="text-sm font-medium text-gray-800">
                    {{ Auth::user()->name ?? 'Admin' }}
                </span>
                <span class="text-xs text-gray-400">
                    {{ Auth::user()->email ?? 'admin@athaconstruction.com' }}
                </span>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md border border-gray-300 px-3 py-1.5 text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <span class="hidden sm:inline">Logout</span>
                    <span class="sm:hidden">Sign out</span>
                </button>
            </form>
        </div>
    </div>
</nav>

