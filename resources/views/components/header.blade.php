@props(['overlay' => false])

<header
    x-data="{
        open: false,
        scrolled: false,
        init() {
            const toggleScroll = () => this.scrolled = window.scrollY > 60;
            window.addEventListener('scroll', toggleScroll);
            toggleScroll();
        }
    }"
    class="atha-header"
    :class="{ 'atha-header--solid': scrolled }"
>
    <div class="atha-header__inner">
        <a href="{{ route('home') }}" class="atha-header__brand">
            <img
                x-show="!scrolled"
                src="{{ asset('images/Atha Logo - High Quality-White.png') }}"
                alt="Atha Construction"
                title="Atha Construction"
                class="atha-header__logo"
            >
            <img
                x-show="scrolled"
                x-cloak
                src="{{ asset('images/Atha Logo - High Quality-1.png') }}"
                alt="Atha Construction"
                title="Atha Construction"
                class="atha-header__logo"
            >
        </a>

        <nav class="atha-header__nav">
            <div class="atha-header__links">
                <a href="{{ route('home') }}" class="atha-header__link {{ request()->routeIs('home') ? 'atha-header__link--active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="atha-header__link {{ request()->routeIs('about') ? 'atha-header__link--active' : '' }}">About</a>
                <a href="{{ route('packages') }}" class="atha-header__link {{ request()->routeIs('packages') ? 'atha-header__link--active' : '' }}">Packages</a>
                <a href="{{ route('properties') }}" class="atha-header__link {{ request()->routeIs('properties') ? 'atha-header__link--active' : '' }}">Properties</a>
                <a href="{{ route('blogs') }}" class="atha-header__link {{ request()->routeIs('blogs') ? 'atha-header__link--active' : '' }}">Blogs</a>
                <a href="{{ route('services') }}" class="atha-header__link {{ request()->routeIs('services') ? 'atha-header__link--active' : '' }}">Services</a>
                <a href="{{ route('cost-estimation') }}" class="atha-header__link {{ request()->routeIs('cost-estimation') ? 'atha-header__link--active' : '' }}">Cost Estimation</a>
                <a href="{{ route('contact') }}" class="atha-header__link {{ request()->routeIs('contact') ? 'atha-header__link--active' : '' }}">Contact Us</a>
            </div>

            <button
                class="atha-header__menu-toggle"
                @click="open = !open"
                :aria-expanded="open"
                aria-label="Toggle navigation"
            >
                <svg x-show="!open" class="atha-header__menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" x-cloak class="atha-header__menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>
    </div>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="atha-header__mobile"
    >
        <div class="atha-header__mobile-inner">
            <a href="{{ route('home') }}" class="atha-header__mobile-link {{ request()->routeIs('home') ? 'atha-header__mobile-link--active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="atha-header__mobile-link {{ request()->routeIs('about') ? 'atha-header__mobile-link--active' : '' }}">About</a>
            <a href="{{ route('packages') }}" class="atha-header__mobile-link {{ request()->routeIs('packages') ? 'atha-header__mobile-link--active' : '' }}">Packages</a>
            <a href="{{ route('properties') }}" class="atha-header__mobile-link {{ request()->routeIs('properties') ? 'atha-header__mobile-link--active' : '' }}">Properties</a>
            <a href="{{ route('blogs') }}" class="atha-header__mobile-link {{ request()->routeIs('blogs') ? 'atha-header__mobile-link--active' : '' }}">Blogs</a>
            <a href="{{ route('services') }}" class="atha-header__mobile-link {{ request()->routeIs('services') ? 'atha-header__mobile-link--active' : '' }}">Services</a>
            <a href="{{ route('cost-estimation') }}" class="atha-header__mobile-link {{ request()->routeIs('cost-estimation') ? 'atha-header__mobile-link--active' : '' }}">Cost Estimation</a>
            <a href="{{ route('contact') }}" class="atha-header__mobile-link {{ request()->routeIs('contact') ? 'atha-header__mobile-link--active' : '' }}">Contact Us</a>
        </div>
    </div>
</header>

@unless($overlay ?? false)
    <div class="atha-header__spacer"></div>
@endunless

@once
    <style>
        [x-cloak] { display: none !important; }

        .atha-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 82px;
            background: rgba(0, 0, 0, 0.88);
            color: #fff;
            z-index: 120;
            transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .atha-header--solid {
            background: #fff;
            color: #0f0f0f;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        }

        .atha-header__inner {
            width: min(1200px, 100%);
            margin: 0 auto;
            height: 100%;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
        }

        .atha-header__brand {
            display: inline-flex;
            align-items: center;
            height: 100%;
        }

        .atha-header__logo {
            height: 50px;
            width: auto;
        }

        .atha-header__nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .atha-header__links {
            display: none;
            align-items: center;
            gap: 20px;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.18em;
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
        }

        @media (min-width: 1024px) {
            .atha-header__links {
                display: flex;
            }
        }

        .atha-header .atha-header__link {
            color: rgba(255, 255, 255, 0.78); /* light for initial (non-solid) header */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .atha-header .atha-header__link--active {
            color: #ffffff; /* full white when active on initial header */
        }

        .atha-header .atha-header__link:hover {
            color: #ffffff;
        }

        .atha-header.atha-header--solid .atha-header__link {
            color: #4b5563; /* gray-700 when header is solid */
        }

        .atha-header.atha-header--solid .atha-header__link--active,
        .atha-header.atha-header--solid .atha-header__link:hover {
            color: #000000; /* black when active/hover on solid header */
        }

        .atha-header__menu-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 999px;
            border: 1px solid currentColor;
            background: transparent;
            cursor: pointer;
        }

        @media (min-width: 1024px) {
            .atha-header__menu-toggle {
                display: none;
            }
        }

        .atha-header__menu-icon {
            width: 22px;
            height: 22px;
        }

        .atha-header__mobile {
            position: fixed;
            top: 82px;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.12);
            z-index: 100;
        }

        .atha-header__mobile-inner {
            padding: 18px 24px 30px;
            display: grid;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 12px;
            font-weight: 600;
        }

        .atha-header__mobile-link {
            padding: 14px 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: #4b5563; /* gray-700 */
            font-weight: 500;
        }

        .atha-header__mobile-link--active {
            color: #000000; /* black */
        }

        .atha-header__mobile-link:last-child {
            border-bottom: none;
        }

        .atha-header__spacer {
            height: 82px;
        }
    </style>
@endonce
