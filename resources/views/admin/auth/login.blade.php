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

<body class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <img
                src="{{ asset('images/Atha Logo - High Quality-1.png') }}"
                alt="Atha Construction"
                class="inline-block h-12 mb-3">
            <h1 class="text-xl font-semibold text-gray-900 font-tenor">Admin Sign In</h1>
            <p class="mt-1 text-sm text-gray-500">Enter your credentials to access the dashboard.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-4 p-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1" for="email">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1" for="password">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center space-x-2 text-gray-700">
                        <input
                            id="rememberMe"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                        <span>Remember me</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full inline-flex justify-center items-center rounded-lg bg-gray-900 px-4 py-2.5 text-xs font-semibold uppercase tracking-wide text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                    Sign in
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Atha Construction. All rights reserved.
        </p>
    </div>
</body>
</html>


