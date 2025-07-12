@extends('layouts.perusahaan')

@section('header', 'Detail Lamaran')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg> Detail Lamaran dari {{ $lamaran->pelamar->user->name ?? 'Pelamar Tidak Dikenal' }}
    </h2>

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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {{-- Informasi Pelamar --}}
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Pelamar</h3>
            <p class="mb-2"><strong class="text-gray-800">Nama:</strong> {{ $lamaran->pelamar->user->name ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Email:</strong> {{ $lamaran->pelamar->user->email ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Nomor Telepon:</strong> {{ $lamaran->pelamar->nomor_telepon ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">NIK:</strong> {{ $lamaran->pelamar->nik ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Tanggal Lahir:</strong> {{ $lamaran->pelamar->tanggal_lahir ? \Carbon\Carbon::parse($lamaran->pelamar->tanggal_lahir)->format('d F Y') : 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Alamat Domisili:</strong> {{ $lamaran->pelamar->alamat_domisili ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Pendidikan:</strong> {{ $lamaran->pelamar->pendidikan ?? 'N/A' }}</p>
            <p class="mb-2"><strong class="text-gray-800">Pengalaman Kerja:</strong> <br><span class="prose max-w-none pl-4">{!! nl2br(e($lamaran->pelamar->pengalaman_kerja)) !!}</span></p>
            <p class="mb-2"><strong class="text-gray-800">Keahlian:</strong> <br><span class="prose max-w-none pl-4">{!! nl2br(e($lamaran->pelamar->keahlian)) !!}</span></p>
            <p class="mb-2"><strong class="text-gray-800">Tanggal Melamar:</strong> {{ \Carbon\Carbon::parse($lamaran->created_at)->format('d F Y H:i') }}</p>
        </div>

        {{-- Dokumen & Manajemen Status --}}
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Dokumen Pelamar</h3>
            @if($lamaran->pelamar->path_cv)
                <p class="text-gray-700 mb-2 flex items-center"><strong>CV/Resume:</strong>
                    <a href="{{ route('perusahaan.lamaran.downloadCv', $lamaran->id) }}" class="text-blue-600 hover:text-blue-800 underline ml-2 inline-flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.586 4.586a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Unduh CV
                    </a>
                </p>
            @else
                <p class="text-red-500 flex items-center"><svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg> CV/Resume tidak tersedia.</p>
            @endif

            @if($lamaran->pelamar->path_foto_profil)
                <p class="text-gray-700 mb-2 mt-4"><strong>Foto Profil:</strong></p>
                <img src="{{ Storage::url($lamaran->pelamar->path_foto_profil) }}" alt="Foto Profil" class="w-32 h-32 object-cover rounded-full shadow-md">
            @else
                <p class="text-gray-500 flex items-center mt-4"><svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg> Foto profil tidak tersedia.</p>
            @endif

            <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4 border-b pb-2">Manajemen Status Lamaran</h3>
            <p class="text-gray-700 mb-4 flex items-center"><strong>Status Saat Ini:</strong>
                <span class="px-3 py-1 rounded-full text-sm font-semibold ml-2
                    @if($lamaran->status_lamaran == 'menunggu') bg-yellow-100 text-yellow-800
                    @elseif($lamaran->status_lamaran == 'dilihat') bg-blue-100 text-blue-800
                    @elseif($lamaran->status_lamaran == 'dalam_proses') bg-purple-100 text-purple-800
                    @elseif($lamaran->status_lamaran == 'diterima') bg-green-100 text-green-800
                    @elseif($lamaran->status_lamaran == 'ditolak') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $lamaran->status_lamaran)) }}
                </span>
            </p>

            <form action="{{ route('perusahaan.lamaran.updateStatus', $lamaran->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <label for="status" class="block text-sm font-medium text-gray-700 sr-only">Ubah Status</label>
                    <select name="status" id="status" class="block w-full sm:w-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach($statuses as $statusOption)
                            <option value="{{ $statusOption }}" {{ $lamaran->status_lamaran == $statusOption ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $statusOption)) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-md font-semibold inline-flex items-center shadow-sm transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-3m-1-4l-3 3m0 0l-3 3m3-3V4m0 0h-3"></path></svg> Update Status
                    </button>
                </div>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </form>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6 flex justify-end">
        <a href="{{ route('perusahaan.lamaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali ke Daftar Lamaran
        </a>
    </div>
</div>
@endsection
