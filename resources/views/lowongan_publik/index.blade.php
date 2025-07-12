<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lowongan - Disnaker Batam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center fixed w-full z-10">
        <div class="flex items-center space-x-3">
    <a href="{{ route('homepage') }}" class="flex items-center space-x-2">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Disnaker" class="h-10 w-auto">
        <span class="text-xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">Disnaker Batam</span>
    </a>
</div>


        <div class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300">Beranda</a>
            <a href="{{ route('lowongan.publik.index') }}" class="text-blue-700 font-bold transition duration-300">Cari Lowongan</a>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition duration-300 ml-4">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-300 ml-4">Daftar</a>
            @endauth
        </div>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-700 focus:outline-none focus:text-blue-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="fixed top-0 left-0 w-full h-full bg-white z-30 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col pt-16">
        <div class="p-4 space-y-4">
    <div class="flex items-center mb-4 space-x-3">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Disnaker" class="h-10 w-auto">
        <span class="text-xl font-bold text-blue-700">Disnaker Batam</span>
    </div>
            <a href="{{ route('homepage') }}" class="block text-gray-700 hover:text-blue-700 font-medium text-lg">Beranda</a>
            <a href="{{ route('lowongan.publik.index') }}" class="block text-blue-700 font-bold text-lg">Cari Lowongan</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block bg-indigo-600 text-white px-5 py-2 rounded-lg text-center text-lg font-semibold hover:bg-indigo-700">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-700 font-medium text-lg">Login</a>
                <a href="{{ route('register') }}" class="block bg-blue-600 text-white px-5 py-2 rounded-lg text-center text-lg font-semibold hover:bg-blue-700">Daftar</a>
            @endauth
        </div>
        <button id="close-mobile-menu" class="absolute top-4 right-4 text-gray-700 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <main class="py-16 container mx-auto px-6 mt-[64px]">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-8 text-center animate-fade-in-down">Temukan Lowongan Kerja</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8 animate-fade-in-up">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center"><svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"></path></svg> Filter Lowongan</h2>
            <form action="{{ route('lowongan.publik.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                    <input type="text" name="keyword" id="keyword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ request('keyword') }}" placeholder="Judul, Perusahaan, Deskripsi">
                </div>
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select name="lokasi" id="lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua Lokasi</option>
                        @foreach($lokasiKerja as $lokasi)
                            <option value="{{ $lokasi->nama_lokasi }}" {{ request('lokasi') == $lokasi->nama_lokasi ? 'selected' : '' }}>{{ $lokasi->nama_lokasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pekerjaan</label>
                    <select name="jenis_pekerjaan" id="jenis_pekerjaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisPekerjaan as $jenis)
                            <option value="{{ $jenis->nama_jenis }}" {{ request('jenis_pekerjaan') == $jenis->nama_jenis ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kategori_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori_pekerjaan" id="kategori_pekerjaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriPekerjaan as $kategori)
                            <option value="{{ $kategori->nama_kategori }}" {{ request('kategori_pekerjaan') == $kategori->nama_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tingkat_pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                    <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua Pendidikan</option>
                        @foreach($tingkatPendidikanOptions as $pendidikan)
                            <option value="{{ $pendidikan }}" {{ request('tingkat_pendidikan') == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="pengalaman_kerja" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
                    <select name="pengalaman_kerja" id="pengalaman_kerja" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Semua Pengalaman</option>
                        @foreach($pengalamanKerjaOptions as $pengalaman)
                            <option value="{{ $pengalaman }}" {{ request('pengalaman_kerja') == $pengalaman ? 'selected' : '' }}>{{ $pengalaman }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="gaji_min" class="block text-sm font-medium text-gray-700 mb-1">Gaji Minimum</label>
                    <input type="number" name="gaji_min" id="gaji_min" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ request('gaji_min') }}" placeholder="Contoh: 3000000">
                </div>
                <div class="md:col-span-1 lg:col-span-1 flex items-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                        <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lowongan Tersedia</h2>

            @forelse ($lowongan as $item)
                <div class="border-b border-gray-200 pb-6 mb-6 last:border-b-0 last:mb-0 flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="md:flex-grow">
                        <h3 class="text-2xl font-bold text-blue-700 mb-1">{{ $item->judul_lowongan }}</h3>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg> {{ $item->perusahaan->nama_perusahaan ?? 'N/A' }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg> {{ $item->lokasi_kerja }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> {{ $item->jenis_pekerjaan }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 002-2V4H4zm10 10v2a2 2 0 002 2h2v-2.586l-2-2L14 14z" clip-rule="evenodd"></path></svg> {{ $item->rentang_gaji ?? 'Negotiable' }}</p>
                    </div>
                    <div class="md:ml-6 mt-4 md:mt-0 flex-shrink-0">
                        <a href="{{ route('lowongan.publik.show', $item->id) }}" class="inline-flex items-center justify-center bg-blue-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-lg text-center p-8">Tidak ada lowongan yang sesuai dengan kriteria Anda saat ini.</p>
            @endforelse

            <div class="mt-8">
                {{ $lowongan->links() }}
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-8 text-center">
        <div class="container mx-auto px-6">
            <p>&copy; 2024 Dinas Tenaga Kerja Kota Batam. All rights reserved.</p>
            <p class="text-sm text-gray-400 mt-2">Didesain dengan <a href="https://tailwindcss.com/" target="_blank" class="underline hover:text-blue-400">Tailwind CSS</a></p>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('-translate-x-full');
        });

        document.getElementById('close-mobile-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('-translate-x-full');
        });
    </script>
</body>
</html>
