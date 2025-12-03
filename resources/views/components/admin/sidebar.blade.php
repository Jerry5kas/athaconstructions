@push('styles')
<style>
    #sidebar-overlay {
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #admin-sidebar {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }
    /* Mobile: Sidebar overlay with shadow */
    @media (max-width: 767px) {
        #admin-sidebar:not(.-translate-x-full) {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    }
    /* Tablet: Ensure sidebar fits properly */
    @media (min-width: 768px) and (max-width: 1023px) {
        #admin-sidebar {
            width: 18rem; /* 288px - slightly narrower for tablets */
        }
    }
    /* Desktop: Full sidebar width */
    @media (min-width: 1024px) {
        #admin-sidebar {
            width: 18rem; /* 288px - w-72 */
        }
    }
</style>
@endpush

{{-- Mobile Overlay --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 md:hidden hidden backdrop-blur-sm"></div>

{{-- Sidebar --}}
<aside
    id="admin-sidebar"
    class="fixed md:relative inset-y-0 left-0 z-50 md:z-auto flex flex-col w-72 md:w-72 bg-gradient-to-b from-white to-gray-50 border-r border-gray-200 shadow-2xl md:shadow-lg overflow-y-auto overflow-x-hidden transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-out h-screen md:h-auto flex-shrink-0">
    {{-- Decorative background pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #000 1px, transparent 0); background-size: 24px 24px;"></div>
    </div>
    
    {{-- Logo / Brand Section --}}
    <div class="relative h-20 flex items-center justify-between px-6 border-b border-gray-200 bg-white">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-gray-700 rounded-lg blur-sm opacity-0 group-hover:opacity-20 transition-opacity"></div>
                <div class="relative bg-gradient-to-br from-gray-900 to-gray-700 p-2 rounded-lg shadow-md">
                    <img
                        src="{{ asset('images/Atha Logo - High Quality-White.png') }}"
                        class="h-6 w-auto"
                alt="Atha Construction" />
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-base tracking-wide font-tenor text-gray-900">
                Atha Admin
            </span>
                <span class="text-[10px] uppercase tracking-wider text-gray-500">
                    Dashboard
                </span>
            </div>
        </a>
        {{-- Close button for mobile --}}
        <button 
            id="sidebar-close"
            class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Navigation Section --}}
    <nav class="flex-1 px-4 py-6 space-y-2 text-sm relative z-10 overflow-y-auto">
        <div class="mb-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 px-3 mb-3">Main Menu</p>
        </div>
        
        {{-- Dashboard --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="group relative flex items-center rounded-xl px-4 py-3 transition-all duration-200
                {{ request()->routeIs('admin.dashboard') 
                    ? 'bg-gradient-to-r from-gray-900 to-gray-800 text-white shadow-lg shadow-gray-900/20' 
                    : 'text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
            @if(request()->routeIs('admin.dashboard'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gray-400 rounded-r-full"></div>
            @endif
            <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3
                {{ request()->routeIs('admin.dashboard') 
                    ? 'bg-white/10' 
                    : 'bg-gray-100 group-hover:bg-gray-200' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-700' }}">Dashboard</span>
            @if(request()->routeIs('admin.dashboard'))
                <svg class="w-4 h-4 ml-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
        </a>

        {{-- Hero Section --}}
        <a
            href="{{ route('admin.hero-sections.index') }}"
            class="group relative flex items-center rounded-xl px-4 py-3 transition-all duration-200
                {{ request()->routeIs('admin.hero-sections.*') 
                    ? 'bg-gradient-to-r from-gray-900 to-gray-800 text-white shadow-lg shadow-gray-900/20' 
                    : 'text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
            @if(request()->routeIs('admin.hero-sections.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gray-400 rounded-r-full"></div>
            @endif
            <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3
                {{ request()->routeIs('admin.hero-sections.*') 
                    ? 'bg-white/10' 
                    : 'bg-gray-100 group-hover:bg-gray-200' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.hero-sections.*') ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium {{ request()->routeIs('admin.hero-sections.*') ? 'text-white' : 'text-gray-700' }}">Hero Section</span>
            @if(request()->routeIs('admin.hero-sections.*'))
                <svg class="w-4 h-4 ml-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
        </a>

        {{-- Categories --}}
        <a
            href="{{ route('admin.categories.index') }}"
            class="group relative flex items-center rounded-xl px-4 py-3 transition-all duration-200
                {{ request()->routeIs('admin.categories.*') 
                    ? 'bg-gradient-to-r from-gray-900 to-gray-800 text-white shadow-lg shadow-gray-900/20' 
                    : 'text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
            @if(request()->routeIs('admin.categories.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gray-400 rounded-r-full"></div>
            @endif
            <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3
                {{ request()->routeIs('admin.categories.*') 
                    ? 'bg-white/10' 
                    : 'bg-gray-100 group-hover:bg-gray-200' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <span class="font-medium {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-700' }}">Categories</span>
            @if(request()->routeIs('admin.categories.*'))
                <svg class="w-4 h-4 ml-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
        </a>

        {{-- Services --}}
        <a
            href="{{ route('admin.services.index') }}"
            class="group relative flex items-center rounded-xl px-4 py-3 transition-all duration-200
                {{ request()->routeIs('admin.services.*') 
                    ? 'bg-gradient-to-r from-gray-900 to-gray-800 text-white shadow-lg shadow-gray-900/20' 
                    : 'text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
            @if(request()->routeIs('admin.services.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gray-400 rounded-r-full"></div>
            @endif
            <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3
                {{ request()->routeIs('admin.services.*') 
                    ? 'bg-white/10' 
                    : 'bg-gray-100 group-hover:bg-gray-200' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-gray-700' }}">Services</span>
            @if(request()->routeIs('admin.services.*'))
                <svg class="w-4 h-4 ml-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
        </a>

        {{-- Users (placeholder for future) --}}
        <a
            href="#"
            class="group relative flex items-center rounded-xl px-4 py-3 text-gray-400 cursor-not-allowed opacity-50">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 bg-gray-50">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            </div>
            <span class="font-medium">Users</span>
            <span class="ml-auto text-[10px] px-2 py-0.5 bg-gray-100 rounded-md">Soon</span>
        </a>
    </nav>

    {{-- User Profile Section at Bottom --}}
    <div class="relative border-t border-gray-200 bg-white p-4 z-10">
        <div class="space-y-3">
            <div class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-900 to-gray-700 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ Auth::user()->name ?? 'Admin User' }}
                    </p>
                    <p class="text-xs text-gray-500 truncate">
                        {{ Auth::user()->email ?? 'admin@athaconstruction.com' }}
                    </p>
                </div>
            </div>
            
            {{-- Sign Out Button --}}
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-gray-900 to-gray-800 text-white font-medium text-sm hover:from-gray-800 hover:to-gray-700 transition-all duration-200 shadow-md hover:shadow-lg group">
                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Floating Toggle Button (Mobile Only) --}}
<button
    id="sidebar-toggle"
    class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 md:hidden z-[60] w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-full shadow-2xl flex items-center justify-center hover:from-gray-800 hover:to-gray-700 transition-all duration-300 hover:scale-110 active:scale-95 group touch-manipulation"
    aria-label="Toggle sidebar"
    style="touch-action: manipulation;">
    <svg id="menu-icon" class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
    <svg id="close-icon" class="w-5 h-5 sm:w-6 sm:h-6 transition-transform duration-300 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
</button>

@push('scripts')
<script>
    (function() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        function openSidebar() {
            if (!sidebar || !overlay) return;
            // Show overlay first with fade-in
            overlay.classList.remove('hidden');
            // Force reflow to ensure overlay is visible
            overlay.offsetHeight;
            overlay.style.opacity = '0';
            // Then slide in sidebar
            setTimeout(() => {
                sidebar.classList.remove('-translate-x-full');
                overlay.style.opacity = '1';
            }, 10);
            
            if (menuIcon) menuIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        }
        
        function closeSidebar() {
            if (!sidebar || !overlay) return;
            // Slide out sidebar first
            sidebar.classList.add('-translate-x-full');
            // Then fade out overlay
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.style.opacity = '';
            }, 300);
            
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }
        
        // Toggle button
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
        }
        
        // Close button
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeSidebar();
            });
        }
        
        // Overlay click to close
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    closeSidebar();
                }
            });
        }
        
        // Close on navigation link click (mobile)
        if (sidebar) {
            const navLinks = sidebar.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        closeSidebar();
                    }
                });
            });
        }
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar && !sidebar.classList.contains('-translate-x-full')) {
                closeSidebar();
            }
        });
        
        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 768) {
                    // On desktop, ensure sidebar is visible
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                    document.documentElement.style.overflow = '';
                } else {
                    // On mobile, ensure sidebar is hidden
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        closeSidebar();
                    }
                }
            }, 100);
        });
    })();
</script>
@endpush

