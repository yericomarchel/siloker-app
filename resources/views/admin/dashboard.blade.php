@extends('layouts.admin')

@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in-down">
    {{-- Card Total Pelamar --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Total Pelamar</h3>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalPelamar }}</p>
        </div>
        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
        </div>
    </div>

    {{-- Card Total Perusahaan --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Total Perusahaan</h3>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalPerusahaan }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zm-2 12H4V5h6v14zm8 0h-6v-2h6v2zm0-4h-6v-2h6v2zm0-4h-6V9h6v2z"></path></svg>
        </div>
    </div>

    {{-- Card Lowongan Aktif --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Lowongan Aktif</h3>
            <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalLowonganAktif }}</p>
        </div>
        <div class="p-3 bg-purple-100 rounded-full text-purple-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 14H8v-2h8v2zm0-4H8V9h8v3z"></path></svg>
        </div>
    </div>

    {{-- Card Lowongan Menunggu Persetujuan --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Lowongan Menunggu Persetujuan</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $totalLowonganMenunggu }}</p>
        </div>
        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in-up">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17 12H7v-2h10v2zm0 4H7v-2h10v2zm0-8H7V6h10v2zM3 22h18V2H3v20zM5 4h14v14H5V4z"></path></svg> Ringkasan Aktivitas Terkini
    </h2>
    <p class="text-gray-600">Anda bisa mendapatkan detail lebih lanjut di masing-masing menu manajemen.</p>
</div>
@endsection
