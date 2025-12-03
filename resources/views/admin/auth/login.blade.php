<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('images/Favicon.png') }}" />
    <title>Admin Login | Atha Construction</title>

    {{-- Fonts & Tailwind (shared app styles) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Tenor+Sans&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }
        .font-tenor {
            font-family: "Tenor Sans", sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        {{-- Logo and Header --}}
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center mb-4">
                <img
                    src="{{ asset('images/Atha Logo - High Quality-1.png') }}"
                    alt="Atha Construction"
                    class="h-16 w-auto">
            </div>
            <h1 class="text-2xl font-semibold text-gray-900 font-tenor mb-2">Admin Sign In</h1>
            <p class="text-sm text-gray-600">Enter your credentials to access the admin dashboard</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 p-4 text-sm text-red-800 bg-red-50 border-l-4 border-red-500 rounded-md">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-medium mb-1">Authentication failed</p>
                            <ul class="list-disc list-inside space-y-1 text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                {{-- Email Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="email">
                        Email Address
                    </label>
                    <div class="relative">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="admin@athaconstructions.com"
                            class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Password Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="Enter your password"
                            class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input
                        id="rememberMe"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900 focus:ring-2">
                    <label for="rememberMe" class="ml-2 block text-sm text-gray-700">
                        Remember me for 30 days
                    </label>
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full inline-flex justify-center items-center rounded-lg bg-gray-900 px-6 py-3 text-sm font-semibold uppercase tracking-wide text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-200 shadow-md hover:shadow-lg">
                    <span>Sign In</span>
                    <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="mt-8 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Atha Construction. All rights reserved.
        </p>
    </div>
</body>
</html>


