<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\KategoriPekerjaan;
use App\Models\JenisPekerjaan;
use App\Models\LokasiKerja;

class DataMasterController extends Controller
{
    // --- Kategori Pekerjaan ---
    public function indexKategori()
    {
        $kategori = KategoriPekerjaan::orderBy('nama_kategori')->paginate(10);
        return view('admin.datamaster.kategori.index', compact('kategori'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_pekerjaan,nama_kategori',
        ]);
        KategoriPekerjaan::create(['nama_kategori' => $request->nama_kategori]);
        return redirect()->route('admin.datamaster.kategori.index')->with('success', 'Kategori Pekerjaan berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, KategoriPekerjaan $kategori)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', Rule::unique('kategori_pekerjaan', 'nama_kategori')->ignore($kategori->id)],
        ]);
        $kategori->update(['nama_kategori' => $request->nama_kategori]);
        return redirect()->route('admin.datamaster.kategori.index')->with('success', 'Kategori Pekerjaan berhasil diperbarui.');
    }

    public function destroyKategori(KategoriPekerjaan $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.datamaster.kategori.index')->with('success', 'Kategori Pekerjaan berhasil dihapus.');
    }

    // --- Jenis Pekerjaan ---
    public function indexJenisPekerjaan()
    {
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_jenis')->paginate(10);
        return view('admin.datamaster.jenis_pekerjaan.index', compact('jenisPekerjaan'));
    }

    public function storeJenisPekerjaan(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_pekerjaan,nama_jenis',
        ]);
        JenisPekerjaan::create(['nama_jenis' => $request->nama_jenis]);
        return redirect()->route('admin.datamaster.jenisPekerjaan.index')->with('success', 'Jenis Pekerjaan berhasil ditambahkan.');
    }

    public function updateJenisPekerjaan(Request $request, JenisPekerjaan $jenisPekerjaan)
    {
        $request->validate([
            'nama_jenis' => ['required', 'string', 'max:255', Rule::unique('jenis_pekerjaan', 'nama_jenis')->ignore($jenisPekerjaan->id)],
        ]);
        $jenisPekerjaan->update(['nama_jenis' => $request->nama_jenis]);
        return redirect()->route('admin.datamaster.jenisPekerjaan.index')->with('success', 'Jenis Pekerjaan berhasil diperbarui.');
    }

    public function destroyJenisPekerjaan(JenisPekerjaan $jenisPekerjaan)
    {
        $jenisPekerjaan->delete();
        return redirect()->route('admin.datamaster.jenisPekerjaan.index')->with('success', 'Jenis Pekerjaan berhasil dihapus.');
    }

    // --- Lokasi Kerja ---
    public function indexLokasi()
    {
        $lokasi = LokasiKerja::orderBy('nama_lokasi')->paginate(10);
        return view('admin.datamaster.lokasi.index', compact('lokasi'));
    }

    public function storeLokasi(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255|unique:lokasi_kerja,nama_lokasi',
        ]);
        LokasiKerja::create(['nama_lokasi' => $request->nama_lokasi]);
        return redirect()->route('admin.datamaster.lokasi.index')->with('success', 'Lokasi Kerja berhasil ditambahkan.');
    }

    public function updateLokasi(Request $request, LokasiKerja $lokasi)
    {
        $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:255', Rule::unique('lokasi_kerja', 'nama_lokasi')->ignore($lokasi->id)],
        ]);
        $lokasi->update(['nama_lokasi' => $request->nama_lokasi]);
        return redirect()->route('admin.datamaster.lokasi.index')->with('success', 'Lokasi Kerja berhasil diperbarui.');
    }

    public function destroyLokasi(LokasiKerja $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('admin.datamaster.lokasi.index')->with('success', 'Lokasi Kerja berhasil dihapus.');
    }
}
