<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>STIFIn Connect</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    @auth
        <a href="{{ route('dashboard') }}" class="hidden">
            Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="hidden">
            Login
        </a>
    @endauth
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="max-w-2xl text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">
                STIFIn Connect
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Sistem Kemitraan dan Pelatihan STIFIn
            </p>
            <p class="text-gray-500 mb-10">
                Kelola jaringan kemitraan, referral, dan pelatihan dalam satu platform yang terintegrasi
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 hover:scale-105 transition duration-300 ease-in-out">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-700 hover:text-white hover:translate-y-1 hover:shadow-lg transition duration-300 ease-in-out">
                    Daftar
                </a>
            </div>
        </div>
    </div>
    {{-- @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif --}}
</body>

</html>
