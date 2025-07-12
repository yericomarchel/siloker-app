@extends('layouts.perusahaan')

@section('header', 'Edit Lowongan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path></svg> Edit Lowongan: {{ $lowongan->judul_lowongan }}
    </h2>

    {{-- Peringatan Status Lowongan --}}
    @if($lowongan->status_lowongan == 'menunggu_persetujuan')
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
            <div class="flex items-center">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2V7H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Lowongan dalam Status Menunggu Persetujuan</p>
                    <p class="text-sm">Perubahan yang Anda lakukan akan memerlukan persetujuan ulang dari Admin.</p>
                </div>
            </div>
        </div>
    @elseif($lowongan->status_lowongan == 'ditolak')
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
            <div class="flex items-center">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2V7H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Lowongan Ditolak</p>
                    <p class="text-sm">Lowongan ini ditolak oleh Admin. Silakan perbaiki detailnya dan simpan untuk mengajukan persetujuan ulang. Alasan penolakan: {{ $lowongan->alasan_penolakan ?? 'Tidak ada alasan spesifik.' }}</p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('perusahaan.lowongan.update', $lowongan->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Informasi Lowongan Umum --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Umum Lowongan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="judul_lowongan" class="block text-sm font-medium text-gray-700 mb-1">Judul Lowongan</label>
                <input type="text" name="judul_lowongan" id="judul_lowongan" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('judul_lowongan') border-red-500 @enderror" value="{{ old('judul_lowongan', $lowongan->judul_lowongan) }}" required>
                @error('judul_lowongan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="kategori_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Kategori Pekerjaan</label>
                <select name="kategori_pekerjaan" id="kategori_pekerjaan" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('kategori_pekerjaan') border-red-500 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoriPekerjaan as $kategori)
                        <option value="{{ $kategori->nama_kategori }}" {{ old('kategori_pekerjaan', $lowongan->kategori_pekerjaan) == $kategori->nama_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('kategori_pekerjaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="jenis_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pekerjaan</label>
                <select name="jenis_pekerjaan" id="jenis_pekerjaan" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('jenis_pekerjaan') border-red-500 @enderror" required>
                    <option value="">Pilih Jenis</option>
                    @foreach($jenisPekerjaan as $jenis)
                        <option value="{{ $jenis->nama_jenis }}" {{ old('jenis_pekerjaan', $lowongan->jenis_pekerjaan) == $jenis->nama_jenis ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
                @error('jenis_pekerjaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="lokasi_kerja" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kerja</label>
                <select name="lokasi_kerja" id="lokasi_kerja" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('lokasi_kerja') border-red-500 @enderror" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($lokasiKerja as $lokasi)
                        <option value="{{ $lokasi->nama_lokasi }}" {{ old('lokasi_kerja', $lowongan->lokasi_kerja) == $lokasi->nama_lokasi ? 'selected' : '' }}>{{ $lokasi->nama_lokasi }}</option>
                    @endforeach
                </select>
                @error('lokasi_kerja') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="rentang_gaji" class="block text-sm font-medium text-gray-700 mb-1">Rentang Gaji (Opsional)</label>
                <input type="text" name="rentang_gaji" id="rentang_gaji" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('rentang_gaji') border-red-500 @enderror" value="{{ old('rentang_gaji', $lowongan->rentang_gaji) }}" placeholder="Contoh: Rp 3jt - 5jt">
                @error('rentang_gaji') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="batas_akhir_lamaran" class="block text-sm font-medium text-gray-700 mb-1">Batas Akhir Lamaran</label>
                <input type="date" name="batas_akhir_lamaran" id="batas_akhir_lamaran" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('batas_akhir_lamaran') border-red-500 @enderror" value="{{ old('batas_akhir_lamaran', $lowongan->batas_akhir_lamaran) }}" required>
                @error('batas_akhir_lamaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Deskripsi dan Kualifikasi --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Detail Pekerjaan</h3>
        <div class="grid grid-cols-1 gap-6 mb-8">
            <div>
                <label for="deskripsi_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan</label>
                <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('deskripsi_pekerjaan') border-red-500 @enderror" required>{{ old('deskripsi_pekerjaan', $lowongan->deskripsi_pekerjaan) }}</textarea>
                @error('deskripsi_pekerjaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="kualifikasi_pelamar" class="block text-sm font-medium text-gray-700 mb-1">Kualifikasi Pelamar</label>
                <textarea name="kualifikasi_pelamar" id="kualifikasi_pelamar" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('kualifikasi_pelamar') border-red-500 @enderror" required>{{ old('kualifikasi_pelamar', $lowongan->kualifikasi_pelamar) }}</textarea>
                @error('kualifikasi_pelamar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex justify-end gap-3">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Simpan Perubahan
            </button>
            <a href="{{ route('perusahaan.lowongan.show', $lowongan->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Batal
            </a>
        </div>
    </form>
</div>
@endsection
