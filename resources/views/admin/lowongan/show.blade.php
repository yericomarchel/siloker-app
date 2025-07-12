@extends('layouts.admin')

@section('header', 'Detail Lowongan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $lowongan->judul_lowongan }}</h1>

    {{-- Job Meta Info --}}
    <div class="text-gray-600 mb-6 flex flex-wrap gap-x-6 gap-y-2 text-lg">
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17.555 17.555A8.001 8.001 0 0012 4a8 8 0 00-5.555 13.555l-1.621 1.621A1 1 0 005.62 20h8.76a1 1 0 00.707-.293l1.62-1.621z"></path></svg>
            {{ $lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}
        </span>
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
            {{ $lowongan->lokasi_kerja }}
        </span>
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
            {{ $lowongan->jenis_pekerjaan }}
        </span>
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 002-2V4H4zm10 10v2a2 2 0 002 2h2v-2.586l-2-2L14 14z" clip-rule="evenodd"></path></svg>
            {{ $lowongan->rentang_gaji ?? 'Negotiable' }}
        </span>
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            Batas Akhir: {{ \Carbon\Carbon::parse($lowongan->batas_akhir_lamaran)->format('d F Y') }}
        </span>
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2V9h-2zm0 2h2v6h-2z"/></svg>
            Kategori: {{ $lowongan->kategori_pekerjaan }}
        </span>
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

    {{-- Status and Actions --}}
    <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg flex flex-col md:flex-row items-center justify-between">
        <div class="mb-4 md:mb-0 md:mr-4">
            <p class="font-semibold text-gray-800">Status Lowongan:</p>
            @php
                $statusClass = '';
                switch ($lowongan->status_lowongan) {
                    case 'aktif': $statusClass = 'bg-green-100 text-green-800'; break;
                    case 'menunggu_persetujuan': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                    case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                    case 'kadaluarsa': $statusClass = 'bg-gray-100 text-gray-800'; break;
                }
            @endphp
            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }}">
                {{ ucfirst(str_replace('_', ' ', $lowongan->status_lowongan)) }}
            </span>
            @if($lowongan->status_lowongan == 'ditolak' && $lowongan->alasan_penolakan)
                <p class="text-red-600 text-sm mt-2">Alasan Penolakan: {{ $lowongan->alasan_penolakan }}</p>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 w-full md:w-auto">
            @if ($lowongan->status_lowongan == 'menunggu_persetujuan')
                <form action="{{ route('admin.lowongan.approve', $lowongan->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 w-full inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg> Setujui Lowongan
                    </button>
                </form>
                <button type="button" onclick="showRejectForm({{ $lowongan->id }})" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 w-full inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg> Tolak Lowongan
                </button>
            @elseif($lowongan->status_lowongan == 'ditolak')
                <p class="text-gray-700">Lowongan ini ditolak. Silakan edit dan ajukan kembali.</p>
            @endif
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6 flex justify-end">
        <a href="{{ route('admin.lowongan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
        </a>
    </div>
</div>

{{-- Reject Modal --}}
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-semibold mb-4">Tolak Lowongan</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="alasan_penolakan" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Alasan penolakan..." required></textarea>
            @error('alasan_penolakan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <div class="flex justify-end mt-4">
                <button type="button" onclick="hideRejectModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2">Batal</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Tolak</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showRejectForm(lowonganId) {
        const form = document.getElementById('rejectForm');
        form.action = `{{ url('admin/lowongan') }}/${lowonganId}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function hideRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }
    window.onclick = function(event) {
        if (event.target.id === 'rejectModal') {
            hideRejectModal();
        }
    }
</script>
@endsection
