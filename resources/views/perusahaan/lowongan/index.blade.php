@extends('layouts.perusahaan')

@section('header', 'Manajemen Lowongan Anda')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center"><svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"></path></svg> Lowongan yang Anda Posting</h2>
        <a href="{{ route('perusahaan.lowongan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Buat Lowongan Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if($lowongan->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Anda belum memposting lowongan apapun.</p>
            <p class="text-gray-500 mt-2">Mulai buat lowongan untuk menemukan kandidat terbaik.</p>
            <a href="{{ route('perusahaan.lowongan.create') }}" class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Buat Lowongan Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($lowongan as $item)
                <div class="bg-gray-50 rounded-lg shadow-sm p-5 border border-gray-200 flex flex-col justify-between transform transition duration-300 hover:scale-102 hover:shadow-lg">
                    <div>
                        <div class="flex items-center mb-2">
                            @if($item->perusahaan->logo_perusahaan) {{-- Menggunakan logo_perusahaan --}}
                                <img src="{{ Storage::url($item->perusahaan->logo_perusahaan) }}" alt="{{ $item->perusahaan->nama_perusahaan }}" class="w-10 h-10 object-contain rounded-full mr-3">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3 text-gray-500 text-xs font-semibold">
                                    {{ substr($item->perusahaan->nama_perusahaan, 0, 2) }}
                                </div>
                            @endif
                            <h3 class="text-xl font-bold text-blue-700">{{ $item->judul_lowongan }}</h3>
                        </div>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg> {{ $item->lokasi_kerja }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> {{ $item->jenis_pekerjaan }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 002-2V4H4zm10 10v2a2 2 0 002 2h2v-2.586l-2-2L14 14z" clip-rule="evenodd"></path></svg> {{ $item->rentang_gaji ?? 'Negotiable' }}</p>
                        <p class="text-gray-700 mb-3 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Batas Akhir: {{ \Carbon\Carbon::parse($item->batas_akhir_lamaran)->format('d M Y') }}</p>

                        @php
                            $statusClass = '';
                            $statusText = ucfirst(str_replace('_', ' ', $item->status_lowongan));
                            switch ($item->status_lowongan) {
                                case 'aktif': $statusClass = 'bg-green-100 text-green-800'; break;
                                case 'menunggu_persetujuan': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                                case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                                case 'kadaluarsa': $statusClass = 'bg-gray-100 text-gray-800'; break;
                            }
                        @endphp
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full">
                        <a href="{{ route('perusahaan.lowongan.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 flex-grow text-center inline-flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Detail
                        </a>
                        @if ($item->status_lowongan == 'menunggu_persetujuan' || $item->status_lowongan == 'ditolak' || $item->status_lowongan == 'kadaluarsa')
                            <a href="{{ route('perusahaan.lowongan.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 flex-grow text-center inline-flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path></svg> Edit
                            </a>
                        @endif
                        <form action="{{ route('perusahaan.lowongan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');" class="flex-grow">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 w-full inline-flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $lowongan->links() }}
        </div>
    @endif
</div>
@endsection
