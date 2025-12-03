<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('images/Favicon.png') }}" />
    <title>@yield('title', 'Admin Dashboard') | Atha Construction</title>

    {{-- Fonts (Tenor Sans + Montserrat) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Tenor+Sans&display=swap" rel="stylesheet">

    {{-- Tailwind (shared app styles) --}}
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: "Montserrat", sans-serif;
            overflow-x: hidden;
        }
        .font-tenor {
            font-family: "Tenor Sans", sans-serif;
        }
        /* Ensure content is visible on mobile */
        @media (max-width: 767px) {
            body > div {
                width: 100%;
            }
        }
        /* Alpine.js cloak */
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 text-slate-800 antialiased overflow-x-hidden">
    <div class="min-h-screen flex">
        {{-- Sidebar (overlay on mobile, part of flex layout on desktop) --}}
        <x-admin.sidebar />

        {{-- Main content (full width on mobile, flex-1 on desktop) --}}
        <div class="flex-1 flex flex-col min-w-0 w-full">
            {{-- Top navbar --}}
            <x-admin.navbar />

            {{-- Page content --}}
            <main class="flex-1 px-4 sm:px-6 py-6 overflow-x-hidden">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>
</html>

