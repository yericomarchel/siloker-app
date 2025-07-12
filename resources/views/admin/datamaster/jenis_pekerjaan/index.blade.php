@extends('layouts.admin')

@section('header', 'Data Master: Jenis Pekerjaan')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
        </svg>
        Manajemen Jenis Pekerjaan
    </h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error Validasi!</strong>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Jenis Pekerjaan --}}
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 4v16m-8-8h16"></path>
            </svg>
            Tambah Jenis Pekerjaan Baru
        </h3>

        <form action="{{ route('admin.datamaster.jenisPekerjaan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf
            <div>
                <label for="nama_jenis" class="block text-sm font-medium text-gray-700">
                    Nama Jenis Pekerjaan
                </label>
                <input
                    id="nama_jenis"
                    name="nama_jenis"
                    type="text"
                    required
                    placeholder="Misal: Full-time, Kontrak"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold shadow-sm transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Daftar --}}
    @if ($jenisPekerjaan->isEmpty())
        <div class="text-center p-8 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-gray-600 text-lg">Belum ada jenis pekerjaan yang terdaftar.</p>
            <p class="text-gray-500 mt-2">Gunakan formulir di atas untuk menambahkannya.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-gray-50 p-4 rounded-lg border border-gray-200">
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">ID</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Nama Jenis</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisPekerjaan as $item)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">{{ $item->id }}</td>
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">
                                <span id="jenis-name-{{ $item->id }}">{{ $item->nama_jenis }}</span>

                                {{-- Inline Edit --}}
                                <form id="edit-form-jenis-{{ $item->id }}" action="{{ route('admin.datamaster.jenisPekerjaan.update', $item->id) }}" method="POST" class="hidden mt-2 flex flex-col sm:flex-row gap-2 sm:gap-0 items-start sm:items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="nama_jenis" value="{{ $item->nama_jenis }}" class="flex-grow sm:w-2/3 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <div class="flex gap-2 mt-2 sm:mt-0">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm inline-flex items-center">Simpan</button>
                                        <button type="button" onclick="cancelEditJenis('{{ $item->id }}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1 rounded-md text-sm inline-flex items-center">Batal</button>
                                    </div>
                                </form>
                            </td>
                            <td class="py-3 px-4 border-b text-sm font-medium">
                                <button type="button" onclick="toggleEditJenis('{{ $item->id }}')" class="text-indigo-600 hover:text-indigo-900 mr-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path>
                                    </svg>
                                    Edit
                                </button>

                                <form action="{{ route('admin.datamaster.jenisPekerjaan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis pekerjaan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $jenisPekerjaan->links() }}
        </div>
    @endif
</div>

<script>
    function toggleEditJenis(id) {
        document.getElementById('jenis-name-' + id).classList.toggle('hidden');
        document.getElementById('edit-form-jenis-' + id).classList.toggle('hidden');
    }

    function cancelEditJenis(id) {
        document.getElementById('jenis-name-' + id).classList.remove('hidden');
        document.getElementById('edit-form-jenis-' + id).classList.add('hidden');
        document.querySelector(`#edit-form-jenis-${id} input[name="nama_jenis"]`).value =
            document.getElementById(`jenis-name-${id}`).textContent.trim();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const hasAddError = @json($errors->has('nama_jenis') && !request()->has('_method'));
        if (hasAddError) {
            const addForm = document.querySelector('form[action="{{ route("admin.datamaster.jenisPekerjaan.store") }}"]');
            if (addForm) addForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else if (@json($errors->any() && request()->has('_method') && request()->route('jenisPekerjaan'))) {
            const editFormId = "{{ request()->route('jenisPekerjaan')->id ?? '' }}";
            if (editFormId) {
                toggleEditJenis(editFormId);
                const editForm = document.getElementById('edit-form-jenis-' + editFormId);
                if (editForm) editForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
</script>
@endsection
