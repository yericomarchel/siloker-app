@extends('layouts.pelamar')

@section('header', 'Riwayat Lamaran Saya')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg> Daftar Riwayat Lamaran
    </h2>

    @if($lamaran->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Anda belum mengirimkan lamaran pekerjaan apa pun.</p>
            <p class="text-gray-500 mt-2">Mulai cari lowongan impian Anda sekarang!</p>
            <a href="{{ route('pelamar.lowongan.index') }}" class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> Cari Lowongan
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach ($lamaran as $item)
                <div class="bg-gray-50 rounded-lg shadow-sm p-5 border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="flex-grow mb-4 md:mb-0">
                        <h3 class="text-xl font-bold text-blue-700 mb-1">{{ $item->lowongan->judul_lowongan ?? 'Lowongan Tidak Ditemukan' }}</h3>
                        <p class="text-gray-700 text-base mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg>
                            {{ $item->lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}
                        </p>
                        <p class="text-gray-600 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            Dilamar pada: {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }} {{-- KOREKSI: Menggunakan created_at --}}
                        </p>
                    </div>

                    <div class="flex flex-col items-start md:items-end space-y-2">
                        @php
                            $statusClass = '';
                            $statusText = '';
                            switch($item->status_lamaran) {
                                case 'menunggu': // KOREKSI: Gunakan nilai enum di DB
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    $statusText = 'Menunggu Review';
                                    break;
                                case 'dilihat': // KOREKSI: Gunakan nilai enum di DB
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                    $statusText = 'Dilihat Perusahaan';
                                    break;
                                case 'dalam_proses': // KOREKSI: Gunakan nilai enum di DB
                                    $statusClass = 'bg-purple-100 text-purple-800';
                                    $statusText = 'Dalam Proses Seleksi';
                                    break;
                                case 'diterima': // KOREKSI: Gunakan nilai enum di DB
                                    $statusClass = 'bg-green-100 text-green-800';
                                    $statusText = 'Diterima';
                                    break;
                                case 'ditolak': // KOREKSI: Gunakan nilai enum di DB
                                    $statusClass = 'bg-red-100 text-red-800';
                                    $statusText = 'Ditolak';
                                    break;
                                default:
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    $statusText = 'Tidak Diketahui';
                                    break;
                            }
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $statusText }}
                        </span>

                        <a href="{{ route('pelamar.lowongan.show', $item->lowongan->id) }}" class="text-blue-600 hover:underline text-sm inline-flex items-center">
                            Lihat Detail Lowongan
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $lamaran->links() }}
        </div>
    @endif
</div>
@endsection
