@extends('layouts.pelamar')

@section('header', 'Profil Saya')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Lengkapi & Edit Profil Anda</h2>

    <form action="{{ route('pelamar.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Akun</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('name') border-red-500 @enderror" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Data Pribadi & Kontak</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" name="nik" id="nik" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('nik') border-red-500 @enderror" value="{{ old('nik', $pelamar->nik) }}" required>
                @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-1">Harus 16 digit angka dan unik.</p>
            </div>
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('tanggal_lahir') border-red-500 @enderror" value="{{ old('tanggal_lahir', $pelamar->tanggal_lahir) }}" required>
                @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="alamat_domisili" class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili</label>
                <textarea name="alamat_domisili" id="alamat_domisili" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('alamat_domisili') border-red-500 @enderror" required>{{ old('alamat_domisili', $pelamar->alamat_domisili) }}</textarea>
                @error('alamat_domisili') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('nomor_telepon') border-red-500 @enderror" value="{{ old('nomor_telepon', $pelamar->nomor_telepon) }}" required>
                @error('nomor_telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Riwayat & Keahlian</h3>
        <div class="grid grid-cols-1 gap-6 mb-8">
            <div>
                <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir (Contoh: S1 Teknik Informatika - Universitas Batam)</label>
                <input type="text" name="pendidikan" id="pendidikan" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('pendidikan') border-red-500 @enderror" value="{{ old('pendidikan', $pelamar->pendidikan) }}" required>
                @error('pendidikan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="pengalaman_kerja" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman Kerja (Contoh: Staff IT - PT ABC, 2020-2024)</label>
                <textarea name="pengalaman_kerja" id="pengalaman_kerja" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('pengalaman_kerja') border-red-500 @enderror" required>{{ old('pengalaman_kerja', $pelamar->pengalaman_kerja) }}</textarea>
                @error('pengalaman_kerja') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="keahlian" class="block text-sm font-medium text-gray-700 mb-1">Keahlian (Contoh: PHP, Laravel, MySQL, Komunikasi)</label>
                <textarea name="keahlian" id="keahlian" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('keahlian') border-red-500 @enderror" required>{{ old('keahlian', $pelamar->keahlian) }}</textarea>
                @error('keahlian') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Dokumen & Foto</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-1">Unggah CV (PDF, Max 5MB)</label>
                <input type="file" name="cv_file" id="cv_file" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 @error('cv_file') border border-red-500 @enderror">
                @error('cv_file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @if ($pelamar->path_cv)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">CV saat ini: <a href="{{ Storage::url($pelamar->path_cv) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.586 4.586a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Lihat CV</a></p>
                    </div>
                @endif
            </div>
            <div>
                <label for="foto_profil" class="block text-sm font-medium text-gray-700 mb-1">Unggah Foto Profil (JPG/PNG, Max 2MB)</label>
                <input type="file" name="foto_profil" id="foto_profil" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 @error('foto_profil') border border-red-500 @enderror">
                @error('foto_profil') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                @if ($pelamar->path_foto_profil)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Foto saat ini:</p>
                        <img src="{{ Storage::url($pelamar->path_foto_profil) }}" alt="Foto Profil" class="h-24 w-24 object-cover rounded-full shadow-md">
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection
