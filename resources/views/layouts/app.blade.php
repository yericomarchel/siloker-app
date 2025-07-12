<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Disnaker Batam') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        {{-- Navbar --}}
        <nav class="bg-white shadow-md p-4 flex justify-between items-center fixed w-full z-20">
            <div class="flex items-center space-x-3">
                <a href="{{ route('homepage') }}" class="flex items-center space-x-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Disnaker" class="h-10 w-auto">
                    <span class="text-xl font-bold text-blue-700">Disnaker Batam</span>
                </a>
            </div>

            <div class="hidden md:flex space-x-6 items-center">
                <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300">Beranda</a>
                <a href="{{ route('lowongan.publik.index') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300">Cari Lowongan</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition duration-300 ml-4">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-300 ml-4">Daftar</a>
                @endauth
            </div>
        </nav>

        <div class="pt-20">
            {{-- Page Heading --}}
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Page Content --}}
            <main class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
