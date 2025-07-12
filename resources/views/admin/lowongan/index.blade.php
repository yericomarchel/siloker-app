@extends('layouts.admin')

@section('header', 'Manajemen Lowongan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 14H8v-2h8v2zm0-4H8V9h8v3z"></path></svg> Daftar Lowongan
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

    @if($lowongan->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Tidak ada lowongan yang ditemukan.</p>
            <p class="text-gray-500 mt-2">Perusahaan belum memposting lowongan atau semua lowongan sudah dikelola.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Judul Lowongan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Perusahaan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Batas Akhir</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Status</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowongan as $item)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">{{ $item->judul_lowongan }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                <div class="flex items-center">
                                    @if($item->perusahaan->logo_perusahaan)
                                        <img src="{{ Storage::url($item->perusahaan->logo_perusahaan) }}" alt="{{ $item->perusahaan->nama_perusahaan }}" class="w-6 h-6 object-contain rounded-full mr-2">
                                    @endif
                                    {{ $item->perusahaan->nama_perusahaan ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ \Carbon\Carbon::parse($item->batas_akhir_lamaran)->format('d M Y') }}</td>
                            <td class="py-3 px-4 border-b">
                                @php
                                    $statusClass = '';
                                    switch ($item->status_lowongan) {
                                        case 'aktif': $statusClass = 'bg-green-100 text-green-800'; break;
                                        case 'menunggu_persetujuan': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                                        case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                                        case 'kadaluarsa': $statusClass = 'bg-gray-100 text-gray-800'; break;
                                    }
                                @endphp
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_lowongan)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-sm font-medium flex items-center space-x-2">
                                <a href="{{ route('admin.lowongan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Detail
                                </a>
                                @if ($item->status_lowongan == 'menunggu_persetujuan')
                                    <form action="{{ route('admin.lowongan.approve', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg> Setujui
                                        </button>
                                    </form>
                                    <button type="button" onclick="showRejectForm({{ $item->id }})" class="text-red-600 hover:text-red-900 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"></path></svg> Tolak
                                    </button>
                                @endif
                                <form action="{{ route('admin.lowongan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-600 hover:text-gray-900 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $lowongan->links() }}
        </div>
    @endif
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
