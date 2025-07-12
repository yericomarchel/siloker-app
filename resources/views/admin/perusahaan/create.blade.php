@extends('layouts.admin')

@section('header', 'Tambah Perusahaan Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Formulir Tambah Perusahaan
    </h2>

    <form action="{{ route('admin.perusahaan.store') }}" method="POST">
        @csrf

        {{-- Informasi Umum Perusahaan --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Umum Perusahaan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <x-forms.text-input
                name="nama_perusahaan"
                label="Nama Perusahaan"
                required
                autofocus
            />

            <x-forms.text-input
                name="email_perusahaan"
                label="Email Perusahaan"
                type="email"
                required
            />

            <x-forms.text-input
                name="npwp_nib"
                label="NPWP/NIB"
                placeholder="Opsional"
            />

            <x-forms.text-input
                name="jenis_usaha"
                label="Jenis Usaha"
                placeholder="Misal: Teknologi, Manufaktur, Jasa"
            />

            <x-forms.textarea-input
                name="alamat_kantor"
                label="Alamat Kantor"
                rows="3"
            />

            <x-forms.text-input
                name="nomor_telepon_perusahaan"
                label="Nomor Telepon Perusahaan"
                type="tel"
            />

            <x-forms.text-input
                name="nama_penanggung_jawab"
                label="Nama Penanggung Jawab"
            />

            <x-forms.text-input
                name="jabatan_penanggung_jawab"
                label="Jabatan Penanggung Jawab"
            />
        </div>

        {{-- Informasi Akun Login --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Akun Login Perusahaan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <x-forms.text-input
                name="email_login"
                label="Email Login (Untuk Perusahaan)"
                type="email"
                required
            />
            <x-forms.text-input
                name="password_login"
                label="Password Login (Minimal 8 Karakter)"
                type="password"
                required
            />
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex justify-end gap-3">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Simpan Perusahaan
            </button>
            <a href="{{ route('admin.perusahaan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Batal
            </a>
        </div>
    </form>
</div>
@endsection
