@extends('layouts.perusahaan')

@section('header', 'Detail Lowongan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $lowongan->judul_lowongan }}</h1>

    {{-- Job Meta Info --}}
    <div class="text-gray-600 mb-6 flex flex-wrap gap-x-6 gap-y-2 text-lg">
        <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg> {{ $lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}</span>
        <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg> {{ $lowongan->lokasi_kerja }}</span>
        <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> {{ $lowongan->jenis_pekerjaan }}</span>
        <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 002-2V4H4zm10 10v2a2 2 0 002 2h2v-2.586l-2-2L14 14z" clip-rule="evenodd"></path></svg> {{ $lowongan->rentang_gaji ?? 'Negotiable' }}</span>
        <span class="flex items-center"><svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg> Batas Akhir: {{ \Carbon\Carbon::parse($lowongan->batas_akhir_lamaran)->format('d F Y') }}</span>
    </div>

    <hr class="my-6 border-gray-200">

    {{-- Job Description --}}
    <div class="mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7.58 4.5 4 8.18 4 12.6V20h16v-7.4C20 8.18 16.42 4.5 12 4.5zm0 2.5c3.04 0 5.5 2.46 5.5 5.5S15.04 18 12 18s-5.5-2.46-5.5-5.5S8.96 7 12 7zm-1 2v4h2v-4h-2z"/></svg> Deskripsi Pekerjaan:
        </h3>
        <div class="prose max-w-none text-gray-700 pl-8 leading-relaxed">
            {!! nl2br(e($lowongan->deskripsi_pekerjaan)) !!}
        </div>
    </div>

    {{-- Qualifications --}}
    <div class="mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-3 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2V9h-2zm0 2h2v6h-2z"/></svg> Kualifikasi Pelamar:
        </h3>
        <div class="prose max-w-none text-gray-700 pl-8 leading-relaxed">
            {!! nl2br(e($lowongan->kualifikasi_pelamar)) !!}
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
        @if ($lowongan->status_lowongan == 'menunggu_persetujuan' || $lowongan->status_lowongan == 'ditolak')
            <a href="{{ route('perusahaan.lowongan.edit', $lowongan->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path></svg> Edit Lowongan
            </a>
        @endif
        <a href="{{ route('perusahaan.lowongan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
        </a>
    </div>
</div>
@endsection
