@extends('layouts.perusahaan')

@section('header', 'Manajemen Lamaran Masuk')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8h16v10zm-4-9H8V7h8v2z"></path></svg> Lamaran yang Masuk ke Perusahaan Anda
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

    {{-- Filter Section --}}
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-700 mb-3">Filter Lamaran</h3>
        <form action="{{ route('perusahaan.lamaran.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Lamaran:</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dilihat" {{ request('status') == 'dilihat' ? 'selected' : '' }}>Dilihat</option>
                    <option value="dalam_proses" {{ request('status') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label for="lowongan_id" class="block text-sm font-medium text-gray-700 mb-1">Lowongan:</label>
                <select name="lowongan_id" id="lowongan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Semua Lowongan</option>
                    @foreach($lowonganPerusahaan as $lowonganItem)
                        <option value="{{ $lowonganItem->id }}" {{ request('lowongan_id') == $lowonganItem->id ? 'selected' : '' }}>{{ $lowonganItem->judul_lowongan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Cari Pelamar (Nama):</label>
                <input type="text" name="keyword" id="keyword" placeholder="Nama Pelamar..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ request('keyword') }}">
            </div>
            <div class="md:col-span-3 flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C14.53 12.56 15 11.28 15 10c0-2.76-2.24-5-5-5S5 7.24 5 10s2.24 5 5 5c1.28 0 2.56-.47 3.53-1.28l.27.28v.79l4.25 4.25c.41.41 1.07.41 1.48 0 .41-.41.41-1.07 0-1.48L15.5 14zm-6 0c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"></path></svg> Terapkan Filter
                </button>
                <a href="{{ route('perusahaan.lamaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 5V2L7 7l5 5V9c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"></path></svg> Reset
                </a>
            </div>
        </form>
    </div>

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

    @if($lamaran->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Belum ada lamaran masuk untuk lowongan Anda yang sesuai filter.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Pelamar</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Lowongan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Tanggal Lamaran</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Status</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lamaran as $item)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">
                                {{ $item->pelamar->user->name ?? 'N/A' }}
                                <p class="text-xs text-gray-500">{{ $item->pelamar->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $item->lowongan->judul_lowongan ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
                            <td class="py-3 px-4 border-b">
                                @php
                                    $statusClass = '';
                                    switch ($item->status_lamaran) {
                                        case 'menunggu': $statusClass = 'bg-blue-100 text-blue-800'; break;
                                        case 'dilihat': $statusClass = 'bg-indigo-100 text-indigo-800'; break;
                                        case 'dalam_proses': $statusClass = 'bg-purple-100 text-purple-800'; break;
                                        case 'diterima': $statusClass = 'bg-green-100 text-green-800'; break;
                                        case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                                        default: $statusClass = 'bg-gray-100 text-gray-800'; break;
                                    }
                                @endphp
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_lamaran)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-sm font-medium">
                                <a href="{{ route('perusahaan.lamaran.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-2 flex items-center inline-flex">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $lamaran->links() }}
        </div>
    @endif
</div>
@endsection
