@extends('layouts.perusahaan')

@section('header', 'Buat Lowongan Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Formulir Lowongan Baru
    </h2>

    <form action="{{ route('perusahaan.lowongan.store') }}" method="POST">
        @csrf

        {{-- Informasi Lowongan Umum --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Umum Lowongan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <x-forms.text-input
                name="judul_lowongan"
                label="Judul Lowongan"
                required
                autofocus
            />

            <x-forms.select-input
                name="kategori_pekerjaan"
                label="Kategori Pekerjaan"
                :options="$kategoriPekerjaan->pluck('nama_kategori', 'nama_kategori')->toArray()"
                required
            />

            <x-forms.select-input
                name="jenis_pekerjaan"
                label="Jenis Pekerjaan"
                :options="$jenisPekerjaan->pluck('nama_jenis', 'nama_jenis')->toArray()"
                required
            />

            <x-forms.select-input
                name="lokasi_kerja"
                label="Lokasi Kerja"
                :options="$lokasiKerja->pluck('nama_lokasi', 'nama_lokasi')->toArray()"
                required
            />

            <x-forms.text-input
                name="rentang_gaji"
                label="Rentang Gaji (Opsional)"
                placeholder="Contoh: Rp 3jt - 5jt"
            />

            <x-forms.text-input
                name="batas_akhir_lamaran"
                label="Batas Akhir Lamaran"
                type="date"
                required
            />
        </div>

        {{-- Deskripsi dan Kualifikasi --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Detail Pekerjaan</h3>
        <div class="grid grid-cols-1 gap-6 mb-8">
            <x-forms.textarea-input
                name="deskripsi_pekerjaan"
                label="Deskripsi Pekerjaan"
                rows="6"
                required
            />

            <x-forms.textarea-input
                name="kualifikasi_pelamar"
                label="Kualifikasi Pelamar"
                rows="6"
                required
            />
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex justify-end gap-3">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Simpan Lowongan
            </button>
            <a href="{{ route('perusahaan.lowongan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Batal
            </a>
        </div>
    </form>
</div>
@endsection
