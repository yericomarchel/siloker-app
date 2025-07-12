@extends('layouts.admin')

@section('header', 'Manajemen Perusahaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mb-8 animate-fade-in">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center"><svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zm-2 12H4V5h6v14zm8 0h-6v-2h6v2zm0-4h-6v-2h6v2zm0-4h-6V9h6v2z"></path></svg> Daftar Perusahaan</h2>
        <a href="{{ route('admin.perusahaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Tambah Perusahaan
        </a>
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

    @if($perusahaan->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg">
            <p class="text-gray-600 text-lg">Belum ada data perusahaan yang terdaftar.</p>
            <p class="text-gray-500 mt-2">Mulai tambahkan perusahaan pertama Anda.</p>
            <a href="{{ route('admin.perusahaan.create') }}" class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m-8-8h16"></path></svg> Tambah Perusahaan Sekarang
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Nama Perusahaan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Email Login</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Status</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perusahaan as $item)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">
                                <div class="flex items-center">
                                    @if($item->logo_perusahaan)
                                        <img src="{{ Storage::url($item->logo_perusahaan) }}" alt="{{ $item->nama_perusahaan }}" class="w-8 h-8 object-contain rounded-full mr-2">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-gray-500 text-xs font-semibold">
                                            {{ substr($item->nama_perusahaan, 0, 2) }}
                                        </div>
                                    @endif
                                    {{ $item->nama_perusahaan }}
                                </div>
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $item->user->email ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border-b">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->is_aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->is_aktif ? 'Aktif' : 'Non-aktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b text-sm font-medium flex items-center space-x-2">
                                <a href="{{ route('admin.perusahaan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> Detail
                                </a>
                                <a href="{{ route('admin.perusahaan.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path></svg> Edit
                                </a>
                                <form action="{{ route('admin.perusahaan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini? Ini akan menghapus semua lowongan dan lamaran terkait.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> Hapus
                                    </button>
                                </form>
                                <form action="{{ route('admin.perusahaan.toggleStatus', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-purple-600 hover:text-purple-900 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 6h2v2h-2zm0 4h2v6h-2z"></path></svg> {{ $item->is_aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $perusahaan->links() }}
        </div>
    @endif
</div>
@endsection
