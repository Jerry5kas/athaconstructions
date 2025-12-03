<nav class="w-full border-b border-gray-200 bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-20">
    <div class="px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        {{-- Left: Page title / breadcrumb with icon --}}
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <div class="hidden md:flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-gray-900 to-gray-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs uppercase tracking-wider text-gray-400 font-semibold">Admin</span>
                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <h1 class="text-sm sm:text-base font-semibold text-gray-900 capitalize font-tenor">
                        @yield('page-title', $pageTitle ?? 'Dashboard')
                    </h1>
                </div>
            </div>
        </div>

        {{-- Right: Actions and User Menu --}}
        <div class="flex items-center space-x-3">
            {{-- Notifications (optional) --}}
            <button class="hidden sm:flex relative items-center justify-center w-9 h-9 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition-colors group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A1.932 1.932 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-emerald-500 rounded-full border-2 border-white"></span>
            </button>

            {{-- Right Actions (User info removed - now in sidebar) --}}
            <div class="flex items-center space-x-3">
                {{-- Optional: Add other action buttons here if needed --}}
            </div>
        </div>
    </div>
</nav>

