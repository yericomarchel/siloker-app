<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disnaker Batam - Temukan Karir Impianmu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom hero pattern or background if desired */
        .hero-background {
            background-image: url('https://source.unsplash.com/random/1600x900/?office,jobsearch'); /* Example random image, consider using a static one for production */
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 0;
        }
        .hero-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: -1;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">

<!-- Ganti bagian navbar di atas dengan ini -->
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

    <!-- Tombol menu mobile -->
    <div class="md:hidden">
        <button id="mobile-menu-button" class="text-gray-700 focus:outline-none focus:text-blue-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
    </div>
</nav>

<!-- Ganti bagian mobile-menu di bawah navbar dengan ini -->
<div id="mobile-menu" class="fixed top-0 left-0 w-full h-full bg-white z-30 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col pt-20 px-4">
    <div class="flex items-center mb-6 space-x-3">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Lambang_Kota_Batam.png" alt="Logo Disnaker" class="h-10 w-auto">
        <span class="text-xl font-bold text-blue-700">Disnaker Batam</span>
    </div>

    <div class="space-y-4">
        <a href="{{ route('homepage') }}" class="block text-gray-700 hover:text-blue-700 font-medium text-lg">Beranda</a>
        <a href="{{ route('lowongan.publik.index') }}" class="block text-gray-700 hover:text-blue-700 font-medium text-lg">Cari Lowongan</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block bg-indigo-600 text-white px-5 py-2 rounded-lg text-center text-lg font-semibold hover:bg-indigo-700">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-700 font-medium text-lg">Login</a>
            <a href="{{ route('register') }}" class="block bg-blue-600 text-white px-5 py-2 rounded-lg text-center text-lg font-semibold hover:bg-blue-700">Daftar</a>
        @endauth
    </div>

    <button id="close-mobile-menu" class="absolute top-4 right-4 text-gray-700 focus:outline-none">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>



    <header class="bg-cover bg-center text-white py-32 text-center relative z-0" style="background-image: url('https://disnaker.batam.go.id/wp-content/uploads/sites/36/2024/03/2.jpg');">
    <div class="container mx-auto px-6 relative z-10 bg-black bg-opacity-50 rounded-lg py-8">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 animate-fade-in-down">
            Temukan Karir Impianmu di <span class="text-yellow-300">Batam</span>
        </h1>
        <p class="text-xl md:text-2xl mb-10 leading-relaxed animate-fade-in-up">
            Ratusan lowongan kerja terbaru dari berbagai perusahaan terkemuka,<br class="hidden md:block">
            langsung dari Dinas Tenaga Kerja Kota Batam.
        </p>
        <a href="http://127.0.0.1:8000/lowongan-publik"
           class="bg-white text-blue-700 px-10 py-4 rounded-full text-lg md:text-xl font-semibold shadow-lg hover:bg-gray-200 transition duration-300 transform hover:scale-105">
            Cari Lowongan Sekarang
            <svg class="inline-block ml-2 w-5 h-5" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</header>


    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12 animate-fade-in">Lowongan Terbaru</h2>

            @if($lowonganTerbaru->isEmpty())
                <div class="text-center p-8 bg-white rounded-lg shadow-md">
                    <p class="text-gray-600 text-lg">Belum ada lowongan aktif yang tersedia saat ini.</p>
                    <p class="text-gray-500 mt-2">Mohon cek kembali nanti atau hubungi Disnaker Batam.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($lowonganTerbaru as $lowongan)
                        <div class="bg-white rounded-lg shadow-md p-6 transform transition duration-300 hover:scale-105 hover:shadow-lg flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-blue-700 mb-2">{{ $lowongan->judul_lowongan }}</h3>
                                <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg> {{ $lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}</p>
                                <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg> {{ $lowongan->lokasi_kerja }}</p>
                                <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> {{ $lowongan->jenis_pekerjaan }}</p>
                                <p class="text-gray-700 mb-4 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414L7.5 9.086 6.207 7.793a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 000-1.414z" clip-rule="evenodd"></path></svg> {{ $lowongan->rentang_gaji ?? 'Negotiable' }}</p>
                            </div>
                            <a href="{{ route('lowongan.publik.show', $lowongan->id) }}" class="mt-4 inline-flex items-center justify-center bg-blue-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="{{ route('lowongan.publik.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                        Lihat Semua Lowongan
                        <svg class="inline-block ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="bg-blue-700 text-white py-16 text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-6">Butuh Bantuan atau Informasi Lebih Lanjut?</h2>
            <p class="text-xl mb-8 leading-relaxed">
                Jangan ragu untuk menghubungi Dinas Tenaga Kerja Kota Batam. <br class="hidden md:block">Kami siap membantu Anda dalam pencarian kerja.
            </p>
            <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="bg-green-500 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-105 inline-flex items-center">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.04 2c-5.46 0-9.92 4.46-9.92 9.92s4.46 9.92 9.92 9.92c4.95 0 9.09-3.6 9.78-8.31l.01-.06V12.92L21.96 12l.02-.38c-.73-4.73-4.88-8.32-9.78-8.32zm.02 1.34c4.66 0 8.52 3.41 9.24 7.82l-.01.27v.03l-1.34-1.34c-.16-.16-.4-.2-.61-.1l-1.57.75c-.32.15-.7.06-1.02-.27l-1.07-1.07c-.32-.32-.42-.7-.27-1.02l.75-1.57c.1-.2.06-.45-.1-.61l-1.34-1.34v-.03l.27-.01c4.4-.72 7.82-4.59 7.82-9.24 0-5.1-4.13-9.24-9.24-9.24S2.8 6.94 2.8 12.04 6.94 21.28 12.04 21.28c4.66 0 8.52-3.41 9.24-7.82l.01-.27zM8.5 7h7v2.5H8.5V7zm0 4h7v2.5H8.5V11zm0 4h7v2.5H8.5V15z"/></svg>
                Hubungi Kami via WhatsApp
            </a>
            <p class="text-sm mt-4 text-blue-200">Jam kerja: Senin - Jumat, 08:00 - 16:00 WIB</p>
        </div>
    </section>

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
