<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Disnaker Batam</title>

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
        /* Sidebar fixed for desktop, overlay for mobile */
        .sidebar {
            width: 250px; /* Lebar sidebar */
            flex-shrink: 0; /* Mencegah sidebar mengecil */
            background-color: #2d3748; /* bg-gray-800 */
            color: #cbd5e0; /* text-gray-300 */
            transition: transform 0.3s ease-in-out; /* Animasi saat muncul/sembunyi */
        }
        @media (min-width: 768px) { /* Untuk desktop dan tablet (>768px) */
            .sidebar {
                transform: translateX(0); /* Sidebar selalu terlihat */
                position: fixed; /* Sidebar tetap di tempat */
                height: 100vh; /* Tinggi penuh */
                top: 0;
                left: 0;
            }
            .content-area {
                margin-left: 250px; /* Beri ruang untuk sidebar di konten utama */
            }
        }
        @media (max-width: 767px) { /* Untuk mobile (<768px) */
            .sidebar {
                position: fixed;
                height: 100vh;
                top: 0;
                left: 0;
                transform: translateX(-100%); /* Tersembunyi secara default */
                z-index: 50; /* Di atas konten lain */
            }
            .sidebar.active {
                transform: translateX(0); /* Tampilkan sidebar */
            }
            .overlay {
                position: fixed;
                inset: 0;
                background-color: rgba(0, 0, 0, 0.5); /* Overlay gelap */
                z-index: 40;
                display: none; /* Tersembunyi secara default */
            }
            .overlay.active {
                display: block; /* Tampilkan overlay */
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 flex min-h-screen"> {{-- body menjadi flex container utama --}}

    {{-- Mobile Header (Hanya untuk mobile, fixed di atas) --}}
    <header class="bg-white shadow-md p-4 flex justify-between items-center md:hidden fixed w-full z-10 top-0">
        <button id="mobile-sidebar-toggle" class="text-gray-700 focus:outline-none focus:text-blue-700">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
        <span class="text-xl font-bold text-blue-700">Admin Disnaker</span>
        {{-- User dropdown on mobile --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = ! open" class="inline-flex items-center text-sm font-medium text-gray-700 focus:outline-none">
                {{ Auth::user()->name }}
                <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-40">
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Akun</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</a>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Overlay for mobile sidebar --}}
    <div id="sidebar-overlay" class="overlay" onclick="closeSidebar()"></div>

    {{-- Sidebar --}}
    <aside id="admin-sidebar" class="sidebar shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-6 text-2xl font-bold text-white border-b border-gray-700">
                Admin Panel
                <button id="close-sidebar-mobile" class="absolute top-4 right-4 text-gray-400 md:hidden hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <nav class="mt-5 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-gray-700 rounded-md mx-2 transition duration-200 @if(request()->routeIs('admin.dashboard')) bg-gray-700 text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path></svg> Dashboard
                </a>
                <a href="{{ route('admin.perusahaan.index') }}" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-gray-700 rounded-md mx-2 transition duration-200 @if(request()->routeIs('admin.perusahaan.*')) bg-gray-700 text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zm-2 12H4V5h6v14zm8 0h-6v-2h6v2zm0-4h-6v-2h6v2zm0-4h-6V9h6v2z"></path></svg> Manajemen Perusahaan
                </a>
                <a href="{{ route('admin.lowongan.index') }}" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-gray-700 rounded-md mx-2 transition duration-200 @if(request()->routeIs('admin.lowongan.*')) bg-gray-700 text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 14H8v-2h8v2zm0-4H8V9h8v3z"></path></svg> Manajemen Lowongan
                </a>
                <a href="{{ route('admin.datamaster.kategori.index') }}" class="flex items-center px-6 py-3 text-sm font-medium hover:bg-gray-700 rounded-md mx-2 transition duration-200 @if(request()->routeIs('admin.datamaster.*')) bg-gray-700 text-white @endif">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg> Data Master
                </a>
                <div class="ml-6 border-l border-gray-700 pl-3 py-1 space-y-1"> {{-- Indentasi untuk submenu --}}
                    <a href="{{ route('admin.datamaster.kategori.index') }}" class="flex items-center px-3 py-2 text-xs font-medium hover:bg-gray-700 rounded-md transition duration-200 @if(request()->routeIs('admin.datamaster.kategori.*')) bg-gray-700 text-white @endif"> - Kategori Pekerjaan</a>
                    <a href="{{ route('admin.datamaster.jenisPekerjaan.index') }}" class="flex items-center px-3 py-2 text-xs font-medium hover:bg-gray-700 rounded-md transition duration-200 @if(request()->routeIs('admin.datamaster.jenisPekerjaan.*')) bg-gray-700 text-white @endif"> - Jenis Pekerjaan</a>
                    <a href="{{ route('admin.datamaster.lokasi.index') }}" class="flex items-center px-3 py-2 text-xs font-medium hover:bg-gray-700 rounded-md transition duration-200 @if(request()->routeIs('admin.datamaster.lokasi.*')) bg-gray-700 text-white @endif"> - Lokasi Kerja</a>
                </div>
            </nav>
        </div>

        <div class="pb-6">
            <div class="px-4 py-3 text-gray-400 border-t border-gray-700 mt-5">
                Logged in as:<br> <strong class="text-white">{{ Auth::user()->name }}</strong> ({{ Auth::user()->role }})
            </div>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center px-6 py-3 text-sm font-medium hover:bg-red-700 text-red-300 rounded-md mx-2 transition duration-200">
                   <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17 19H6c-1.1 0-2-.9-2-2V7c0-1.1.9-2 2-2h11v-1H6c-1.66 0-3 1.34-3 3v10c0 1.66 1.34 3 3 3h11v-1zm5-9l-4-4v3H9v2h9v3l4-4z"></path></svg> Log Out
                </a>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 min-h-screen p-6 md:ml-0 pt-[72px] md:pt-6 content-area"> {{-- Adjusted pt for mobile header --}}
        {{-- Flash Messages --}}
        <div class="max-w-7xl mx-auto px-0 sm:px-0 lg:px-0 mb-4"> {{-- Removed px for consistency --}}
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

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
    </div>

    {{-- Footer (Optional, if you want a fixed footer across all pages) --}}


    <script>
        // JavaScript for Sidebar Toggle on Mobile
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleButton = document.getElementById('mobile-sidebar-toggle');
        const closeSidebarButton = document.getElementById('close-sidebar-mobile');

        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        if (toggleButton) {
            toggleButton.addEventListener('click', openSidebar);
        }
        if (closeSidebarButton) {
            closeSidebarButton.addEventListener('click', closeSidebar);
        }

        // Close sidebar if window resized to desktop from mobile view
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeSidebar();
            }
        });
    </script>
</body>
</html>
