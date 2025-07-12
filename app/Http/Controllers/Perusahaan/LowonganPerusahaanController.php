<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\KategoriPekerjaan;
use App\Models\JenisPekerjaan;
use App\Models\LokasiKerja;

class LowonganPerusahaanController extends Controller
{
    public function index()
    {
        $perusahaanId = Auth::user()->perusahaan->id;
        $lowongan = Lowongan::where('perusahaan_id', $perusahaanId)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        return view('perusahaan.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        $kategoriPekerjaan = KategoriPekerjaan::orderBy('nama_kategori')->get();
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_jenis')->get();
        $lokasiKerja = LokasiKerja::orderBy('nama_lokasi')->get();

        return view('perusahaan.lowongan.create', compact('kategoriPekerjaan', 'jenisPekerjaan', 'lokasiKerja'));
    }

    public function store(Request $request)
    {
        $perusahaanId = Auth::user()->perusahaan->id;

        $request->validate([
            'judul_lowongan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'jenis_pekerjaan' => ['required', Rule::in(JenisPekerjaan::pluck('nama_jenis')->toArray())],
            'lokasi_kerja' => ['required', Rule::in(LokasiKerja::pluck('nama_lokasi')->toArray())],
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi_pelamar' => 'required|string',
            'rentang_gaji' => 'nullable|string|max:255',
            'batas_akhir_lamaran' => 'required|date|after_or_equal:today',
        ]);

        Lowongan::create([
            'perusahaan_id' => $perusahaanId,
            'judul_lowongan' => $request->judul_lowongan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'kualifikasi_pelamar' => $request->kualifikasi_pelamar,
            'rentang_gaji' => $request->rentang_gaji,
            'batas_akhir_lamaran' => $request->batas_akhir_lamaran,
            'status_lowongan' => 'menunggu_persetujuan',
        ]);

        return redirect()->route('perusahaan.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan dan menunggu persetujuan Admin.');
    }

    public function show(Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== Auth::user()->perusahaan->id) {
            abort(403, 'Anda tidak memiliki izin untuk melihat lowongan ini.');
        }
        return view('perusahaan.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== Auth::user()->perusahaan->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit lowongan ini.');
        }

        $kategoriPekerjaan = KategoriPekerjaan::orderBy('nama_kategori')->get();
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_jenis')->get();
        $lokasiKerja = LokasiKerja::orderBy('nama_lokasi')->get();

        return view('perusahaan.lowongan.edit', compact('lowongan', 'kategoriPekerjaan', 'jenisPekerjaan', 'lokasiKerja'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== Auth::user()->perusahaan->id) {
            abort(403, 'Anda tidak memiliki izin untuk memperbarui lowongan ini.');
        }

        $request->validate([
            'judul_lowongan' => 'required|string|max:255',
            'kategori_pekerjaan' => 'required|string|max:255',
            'jenis_pekerjaan' => ['required', Rule::in(JenisPekerjaan::pluck('nama_jenis')->toArray())],
            'lokasi_kerja' => ['required', Rule::in(LokasiKerja::pluck('nama_lokasi')->toArray())],
            'deskripsi_pekerjaan' => 'required|string',
            'kualifikasi_pelamar' => 'required|string',
            'rentang_gaji' => 'nullable|string|max:255',
            'batas_akhir_lamaran' => 'required|date|after_or_equal:today',
        ]);

        $lowongan->update([
            'judul_lowongan' => $request->judul_lowongan,
            'kategori_pekerjaan' => $request->kategori_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'kualifikasi_pelamar' => $request->kualifikasi_pelamar,
            'rentang_gaji' => $request->rentang_gaji,
            'batas_akhir_lamaran' => $request->batas_akhir_lamaran,
        ]);

        return redirect()->route('perusahaan.lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== Auth::user()->perusahaan->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus lowongan ini.');
        }

        $lowongan->delete();
        return redirect()->route('perusahaan.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}
