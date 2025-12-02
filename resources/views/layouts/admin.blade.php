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
        }
        .font-tenor {
            font-family: "Tenor Sans", sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 text-slate-800 antialiased">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <x-admin.sidebar />

        {{-- Main column --}}
        <div class="flex-1 flex flex-col">
            {{-- Top navbar --}}
            <x-admin.navbar />

            {{-- Page content --}}
            <main class="flex-1 px-6 py-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

