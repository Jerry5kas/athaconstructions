<aside
    class="hidden md:flex md:flex-col w-64 bg-white border-r border-gray-200">
    {{-- Logo / Brand --}}
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <img
                src="{{ asset('images/Atha Logo - High Quality-1.png') }}"
                class="h-8 w-auto"
                alt="Atha Construction" />
            <span class="font-semibold text-sm tracking-wide font-tenor">
                Atha Admin
            </span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
        {{-- Dashboard --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center rounded-md px-3 py-2 transition-colors
                {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            {{-- Heroicon: Home --}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-5 h-5 mr-2"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 11.25 12 4l9 7.25" />
                <path d="M5 10.75V20h4.5v-4.5H14V20h4.5v-9.25" />
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- Users (placeholder for future) --}}
        <a
            href="#"
            class="flex items-center rounded-md px-3 py-2 text-gray-400 cursor-not-allowed opacity-60">
            {{-- Heroicon: User Group --}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-5 h-5 mr-2"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M9 11.25A2.75 2.75 0 1 0 9 5.75a2.75 2.75 0 0 0 0 5.5Z" />
                <path d="M15 11.25A2.75 2.75 0 1 0 15 5.75a2.75 2.75 0 0 0 0 5.5Z" />
                <path d="M3.75 18.25a4.5 4.5 0 0 1 8.5-2" />
                <path d="M11.75 16.25a4.5 4.5 0 0 1 8.5 2" />
            </svg>
            <span>Users</span>
        </a>

        {{-- Hero Section (Home) --}}
        <a
            href="{{ route('admin.hero-sections.index') }}"
            class="flex items-center rounded-md px-3 py-2 transition-colors
                {{ request()->routeIs('admin.hero-sections.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            {{-- Heroicon: Photo --}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-5 h-5 mr-2"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">
                <rect x="3.5" y="5" width="17" height="14" rx="2" ry="2" />
                <path d="M4.5 15.5 9 11l4 4 3-3 4.5 4.5" />
                <circle cx="9" cy="9" r="0.75" />
            </svg>
            <span>Hero Section</span>
        </a>
    </nav>
</aside>

