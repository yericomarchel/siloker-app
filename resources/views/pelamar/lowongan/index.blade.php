@extends('layouts.pelamar')

@section('header', 'Cari Lowongan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"></path></svg> Filter & Cari Lowongan
    </h2>
    <form action="{{ route('pelamar.lowongan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
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

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Hasil Pencarian Lowongan</h2>

    @if($lowongan->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Tidak ada lowongan yang sesuai dengan kriteria Anda saat ini.</p>
            <p class="text-gray-500 mt-2">Coba sesuaikan filter atau cari dengan kata kunci lain.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($lowongan as $item)
                <div class="bg-gray-50 rounded-lg shadow-sm p-5 border border-gray-200 transform transition duration-300 hover:scale-102 hover:shadow-lg flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-blue-700 mb-2">{{ $item->judul_lowongan }}</h3>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg> {{ $item->perusahaan->nama_perusahaan ?? 'N/A' }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg> {{ $item->lokasi_kerja }}</p>
                        <p class="text-gray-700 mb-1 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> {{ $item->jenis_pekerjaan }}</p>
                        <p class="text-gray-700 mb-3 flex items-center"><svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 002-2V4H4zm10 10v2a2 2 0 002 2h2v-2.586l-2-2L14 14z" clip-rule="evenodd"></path></svg> {{ $item->rentang_gaji ?? 'Negotiable' }}</p>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('pelamar.lowongan.show', $item->id) }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 w-full">
                            Lihat Detail & Melamar
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
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
