@extends('layouts.perusahaan')

@section('header', 'Profil Perusahaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg> Edit Profil Perusahaan Anda
    </h2>

    <form action="{{ route('perusahaan.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Informasi Perusahaan --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Umum Perusahaan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <x-forms.text-input
                name="nama_perusahaan"
                label="Nama Perusahaan"
                :value="$perusahaan->nama_perusahaan"
                required
                autofocus
                autocomplete="nama_perusahaan"
            />

            <x-forms.text-input
                name="email_perusahaan"
                label="Email Perusahaan"
                type="email"
                :value="$perusahaan->email_perusahaan"
                required
                autocomplete="email_perusahaan"
            />

            <x-forms.text-input
                name="npwp_nib"
                label="NPWP/NIB"
                :value="$perusahaan->npwp_nib"
                placeholder="Opsional"
            />

            <x-forms.text-input
                name="jenis_usaha"
                label="Jenis Usaha"
                :value="$perusahaan->jenis_usaha"
                placeholder="Misal: Teknologi, Manufaktur, Jasa"
            />

            <x-forms.textarea-input
                name="alamat_kantor"
                label="Alamat Kantor"
                :value="$perusahaan->alamat_kantor"
                rows="3"
            />

            <x-forms.text-input
                name="nomor_telepon_perusahaan"
                label="Nomor Telepon Perusahaan"
                type="tel"
                :value="$perusahaan->nomor_telepon_perusahaan"
            />

            <x-forms.text-input
                name="nama_penanggung_jawab"
                label="Nama Penanggung Jawab"
                :value="$perusahaan->nama_penanggung_jawab"
            />

            <x-forms.text-input
                name="jabatan_penanggung_jawab"
                label="Jabatan Penanggung Jawab"
                :value="$perusahaan->jabatan_penanggung_jawab"
            />

            <x-forms.textarea-input
                name="deskripsi_singkat"
                label="Deskripsi Singkat Perusahaan"
                :value="$perusahaan->deskripsi_singkat"
                rows="5"
                placeholder="Jelaskan secara singkat tentang perusahaan Anda..."
            />

            {{-- Input file logo tetap manual karena penanganannya khusus --}}
            <div class="md:col-span-2">
                <label for="logo_perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Logo Perusahaan (Max 2MB, JPG/PNG)</label>
                <input id="logo_perusahaan" name="logo_perusahaan" type="file" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 @error('logo_perusahaan') border border-red-500 @enderror">
                @error('logo_perusahaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @if ($perusahaan->logo_perusahaan)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Logo saat ini:</p>
                        <img src="{{ Storage::url($perusahaan->logo_perusahaan) }}" alt="Logo Perusahaan" class="h-24 w-24 object-contain">
                    </div>
                @endif
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Update Profil
            </button>
        </div>
    </form>
</div>
@endsection
