@extends('layouts.pelamar')

@section('header', 'Dashboard Pelamar')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-md col-span-1 md:col-span-2">
        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
        <p class="text-gray-600 leading-relaxed">Ini adalah dashboard pribadi Anda. Di sini Anda bisa memantau kemajuan, mencari lowongan, dan mengelola lamaran Anda.</p>
        <div class="mt-5 flex flex-wrap gap-4">
            <a href="{{ route('pelamar.lowongan.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> Cari Lowongan Baru
            </a>
            <a href="{{ route('pelamar.lamaran.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg> Riwayat Lamaran
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg> Kelengkapan Profil
        </h3>
        <p class="text-3xl font-bold text-blue-600 mb-2">{{ $profileCompletion }}%</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $profileCompletion }}%"></div>
        </div>
        @if (!$isProfileComplete)
            <p class="text-red-500 text-sm mt-3">Profil Anda belum lengkap. Lengkapi untuk melamar!</p>
            <a href="{{ route('pelamar.profil.edit') }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Lengkapi Sekarang &rarr;</a>
        @else
            <p class="text-green-600 text-sm mt-3">Profil Anda sudah lengkap. Siap melamar!</p>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8h16v10zm-4-9H8V7h8v2z"></path></svg> Status Lamaran Anda
        </h3>
        <div class="flex justify-between items-center mb-4">
            <p class="text-3xl font-bold text-blue-600">{{ $jumlahLamaranTerkirim }}</p>
            <span class="text-gray-600">Lamaran Terkirim</span>
        </div>

        <a href="{{ route('pelamar.lamaran.index') }}" class="text-indigo-600 hover:underline font-medium text-sm">Lihat Detail Riwayat Lamaran &rarr;</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2V9h-2zm0 2h2v6h-2z"/></svg> Lowongan Rekomendasi
        </h3>
        <p class="text-gray-600">Fitur rekomendasi lowongan sedang dikembangkan. Jelajahi lowongan di bagian "Cari Lowongan".</p>
        <div class="mt-4">
            <a href="{{ route('pelamar.lowongan.index') }}" class="text-blue-600 hover:underline font-medium text-sm">Cari Lowongan &rarr;</a>
        </div>
    </div>
</div>
@endsection
