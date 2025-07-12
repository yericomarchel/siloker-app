@extends('layouts.perusahaan')

@section('header', 'Dashboard Perusahaan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Card Total Lowongan --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Total Lowongan</h3>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalLowongan }}</p>
        </div>
        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 14H8v-2h8v2zm0-4H8V9h8v3z"></path></svg>
        </div>
    </div>

    {{-- Card Lowongan Aktif --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Lowongan Aktif</h3>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $lowonganAktif }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg>
        </div>
    </div>

    {{-- Card Menunggu Persetujuan --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Menunggu Persetujuan</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $lowonganMenungguPersetujuan }}</p>
        </div>
        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
        </div>
    </div>

    {{-- Card Lowongan Ditolak --}}
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between transition duration-300 transform hover:scale-102 hover:shadow-lg">
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Lowongan Ditolak</h3>
            <p class="text-3xl font-bold text-red-600 mt-1">{{ $lowonganDitolak }}</p>
        </div>
        <div class="p-3 bg-red-100 rounded-full text-red-600">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg>
        </div>
    </div>
</div>

{{-- Peringatan Penting Section --}}
@if($lowonganAkanKadaluarsa->isNotEmpty() || $lowonganDitolak > 0)
<div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 shadow-md" role="alert">
    <div class="flex items-center">
        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2V7H9V5z"/></svg></div>
        <div>
            <p class="font-bold">Perhatian!</p>
            @if($lowonganAkanKadaluarsa->isNotEmpty())
                <p class="text-sm">Ada {{ $lowonganAkanKadaluarsa->count() }} lowongan Anda yang akan kadaluarsa dalam 7 hari atau sudah kadaluarsa. Segera perbarui atau nonaktifkan:</p>
                <ul class="list-disc list-inside mt-2">
                    @foreach($lowonganAkanKadaluarsa as $lowongan)
                        <li><a href="{{ route('perusahaan.lowongan.edit', $lowongan->id) }}" class="text-red-600 hover:underline">{{ $lowongan->judul_lowongan }} (Batas Akhir: {{ \Carbon\Carbon::parse($lowongan->batas_akhir_lamaran)->format('d M Y') }})</a></li>
                    @endforeach
                </ul>
            @endif
            @if($lowonganDitolak > 0)
                <p class="text-sm mt-2">Ada {{ $lowonganDitolak }} lowongan Anda yang ditolak. Silakan cek detailnya untuk perbaikan.</p>
                <a href="{{ route('perusahaan.lowongan.index', ['status' => 'ditolak']) }}" class="text-red-600 hover:underline text-sm mt-1 inline-block">Lihat Lowongan Ditolak</a>
            @endif
        </div>
    </div>
</div>
@endif

{{-- Lowongan Terbaru Anda Section --}}
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13H5v-2h14v2zm-6-2V3h-2v8H3v2h8v8h2v-8h8v-2h-8z"></path></svg> Lowongan Terbaru Anda
    </h2>
    @if ($lowonganTerbaru->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Anda belum memposting lowongan apapun.</p>
            <a href="{{ route('perusahaan.lowongan.create') }}" class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Buat Lowongan Pertama Anda
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Judul Lowongan</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Jenis Pekerjaan</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Batas Akhir</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Status</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowonganTerbaru as $item)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">{{ $item->judul_lowongan }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $item->jenis_pekerjaan }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ \Carbon\Carbon::parse($item->batas_akhir_lamaran)->format('d M Y') }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                @php
                                    $statusClass = '';
                                    switch ($item->status_lowongan) {
                                        case 'aktif': $statusClass = 'bg-green-100 text-green-800'; break;
                                        case 'menunggu_persetujuan': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                                        case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                                        case 'kadaluarsa': $statusClass = 'bg-gray-100 text-gray-800'; break;
                                    }
                                @endphp
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_lowongan)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-sm font-medium">
                                <a href="{{ route('perusahaan.lowongan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-2 flex items-center inline-flex">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('perusahaan.lowongan.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold transition duration-300 inline-flex items-center">
                Lihat Semua Lowongan
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    @endif
</div>

{{-- Lamaran Terbaru Masuk Section --}}
<div class="bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8h16v10zm-4-9H8V7h8v2z"></path></svg> Lamaran Terbaru Masuk
    </h2>
    @if($lamaranTerbaru->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Belum ada lamaran baru masuk.</p>
            <p class="text-gray-500 mt-2">Pastikan lowongan Anda aktif dan menarik!</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($lamaranTerbaru as $lamaran)
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-between">
                    <div>
                        <p class="text-lg font-semibold text-gray-800">{{ $lamaran->pelamar->user->name ?? 'Pelamar Tidak Dikenal' }}</p>
                        <p class="text-sm text-gray-600">Lowongan: <span class="font-medium">{{ $lamaran->lowongan->judul_lowongan ?? 'N/A' }}</span></p>
                        <p class="text-xs text-gray-500">Dilamar: {{ \Carbon\Carbon::parse($lamaran->created_at)->diffForHumans() }}</p>
                    </div>
                    <a href="{{ route('perusahaan.lamaran.show', $lamaran->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Lihat
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('perusahaan.lamaran.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold transition duration-300 inline-flex items-center">
                Lihat Semua Lamaran
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    @endif
</div>
@endsection
