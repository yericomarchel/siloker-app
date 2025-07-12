<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perusahaan - Disnaker Batam</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom scrollbar for better UX if content overflows */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e2e8f0; /* bg-gray-200 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8; /* bg-slate-400 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b; /* bg-slate-600 */
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-white shadow-md p-4 flex justify-between items-center fixed w-full z-20 top-0">
        <div class="flex items-center">
            <a href="{{ route('perusahaan.dashboard') }}" class="text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">
                Disnaker Batam
            </a>
        </div>

        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('perusahaan.dashboard') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300 @if(request()->routeIs('perusahaan.dashboard')) font-semibold text-blue-700 @endif">Dashboard</a>
            <a href="{{ route('perusahaan.profil.edit') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300 @if(request()->routeIs('perusahaan.profil.*')) font-semibold text-blue-700 @endif">Profil Perusahaan</a>
            <a href="{{ route('perusahaan.lowongan.index') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300 @if(request()->routeIs('perusahaan.lowongan.*')) font-semibold text-blue-700 @endif">Manajemen Lowongan</a>
            <a href="{{ route('perusahaan.lamaran.index') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300 @if(request()->routeIs('perusahaan.lamaran.*')) font-semibold text-blue-700 @endif">Manajemen Lamaran</a>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-40">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profil Akun</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Log Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-700 focus:outline-none focus:text-blue-700">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="closeMobileMenu()"></div>

    <div id="mobile-menu" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-40 transform -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <span class="text-xl font-bold text-blue-700">Menu</span>
            <button id="close-mobile-menu" onclick="closeMobileMenu()" class="text-gray-700 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('perusahaan.dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium @if(request()->routeIs('perusahaan.dashboard')) bg-blue-100 text-blue-700 font-semibold @endif">Dashboard</a>
            <a href="{{ route('perusahaan.profil.edit') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium @if(request()->routeIs('perusahaan.profil.*')) bg-blue-100 text-blue-700 font-semibold @endif">Profil Perusahaan</a>
            <a href="{{ route('perusahaan.lowongan.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium @if(request()->routeIs('perusahaan.lowongan.*')) bg-blue-100 text-blue-700 font-semibold @endif">Manajemen Lowongan</a>
            <a href="{{ route('perusahaan.lamaran.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium @if(request()->routeIs('perusahaan.lamaran.*')) bg-blue-100 text-blue-700 font-semibold @endif">Manajemen Lamaran</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-red-100 hover:text-red-700 font-medium">Log Out</a>
            </form>
        </nav>
    </div>

    <div class="flex-grow pt-[64px]">
        <header class="bg-white shadow-sm py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-xl font-semibold text-gray-800 leading-tight">
                    @yield('header')
                </h1>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Peringatan!</strong>
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Info!</strong>
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif
        </div>

        <main class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-900 text-white py-6 text-center mt-auto">
        <div class="container mx-auto px-6">
            <p>&copy; {{ date('Y') }} Dinas Tenaga Kerja Kota Batam. All rights reserved.</p>
            <p class="text-sm text-gray-400 mt-1">Didesain dengan <a href="https://tailwindcss.com/" target="_blank" class="underline hover:text-blue-400">Tailwind CSS</a></p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('-translate-x-full');
            document.getElementById('mobile-menu-overlay').classList.remove('hidden');
        });

        function closeMobileMenu() {
            document.getElementById('mobile-menu').classList.add('-translate-x-full');
            document.getElementById('mobile-menu-overlay').classList.add('hidden');
        }

        // Close menu if ESC is pressed
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMobileMenu();
            }
        });
    </script>
</body>
</html>
