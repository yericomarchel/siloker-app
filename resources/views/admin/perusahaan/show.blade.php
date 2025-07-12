@extends('layouts.admin')

@section('header', 'Detail Perusahaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg> Detail Perusahaan: {{ $perusahaan->nama_perusahaan }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Kartu Informasi Perusahaan --}}
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Umum</h3>
            <div class="space-y-2 text-gray-700">
                <p><strong>Nama Perusahaan:</strong> {{ $perusahaan->nama_perusahaan }}</p>
                <p><strong>Jenis Usaha:</strong> {{ $perusahaan->jenis_usaha ?? '-' }}</p>
                <p><strong>Email Perusahaan:</strong> {{ $perusahaan->email_perusahaan }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $perusahaan->nomor_telepon_perusahaan ?? '-' }}</p>
                <p><strong>NPWP/NIB:</strong> {{ $perusahaan->npwp_nib ?? '-' }}</p>
                <p><strong>Alamat Kantor:</strong> {{ $perusahaan->alamat_kantor ?? '-' }}</p>
                <p><strong>Deskripsi Singkat:</strong> {{ $perusahaan->deskripsi_singkat ?? '-' }}</p>
            </div>
            @if($perusahaan->logo_perusahaan)
                <div class="mt-4">
                    <p class="font-semibold text-gray-700">Logo Perusahaan:</p>
                    <img src="{{ Storage::url($perusahaan->logo_perusahaan) }}" alt="Logo Perusahaan" class="h-24 w-auto object-contain mt-2">
                </div>
            @endif
        </div>

        {{-- Kartu Informasi Kontak & Status --}}
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Kontak & Status</h3>
            <div class="space-y-2 text-gray-700">
                <p><strong>Email Login:</strong> {{ $perusahaan->user->email ?? 'N/A' }}</p>
                <p><strong>Nama Penanggung Jawab:</strong> {{ $perusahaan->nama_penanggung_jawab ?? '-' }}</p>
                <p><strong>Jabatan Penanggung Jawab:</strong> {{ $perusahaan->jabatan_penanggung_jawab ?? '-' }}</p>
                <p><strong>Status Akun:</strong>
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $perusahaan->is_aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $perusahaan->is_aktif ? 'Aktif' : 'Non-aktif' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('admin.perusahaan.edit', $perusahaan->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path></svg> Edit Perusahaan
        </a>
        <a href="{{ route('admin.perusahaan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
        </a>
    </div>
</div>
@endsection
