<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

// Import model Data Master
use App\Models\KategoriPekerjaan;
use App\Models\JenisPekerjaan;
use App\Models\LokasiKerja;

class PublicLowonganController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar lowongan aktif
        $query = Lowongan::with('perusahaan')
                         ->where('status_lowongan', 'aktif')
                         ->whereDate('batas_akhir_lamaran', '>=', now())
                         ->orderBy('created_at', 'desc');

        // Implementasi Filter Lowongan
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('judul_lowongan', 'like', '%' . $request->keyword . '%')
                  ->orWhere('deskripsi_pekerjaan', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('perusahaan', function($qPerusahaan) use ($request) {
                      $qPerusahaan->where('nama_perusahaan', 'like', '%' . $request->keyword . '%');
                  });
            });
        }
        if ($request->filled('lokasi')) {
            $query->where('lokasi_kerja', $request->lokasi);
        }
        if ($request->filled('jenis_pekerjaan')) {
            $query->where('jenis_pekerjaan', $request->jenis_pekerjaan);
        }
        if ($request->filled('kategori_pekerjaan')) {
            $query->where('kategori_pekerjaan', $request->kategori_pekerjaan);
        }
        if ($request->filled('tingkat_pendidikan')) {
            $query->where('kualifikasi_pelamar', 'like', '%' . $request->tingkat_pendidikan . '%');
        }
        if ($request->filled('pengalaman_kerja')) {
            $query->where('kualifikasi_pelamar', 'like', '%' . $request->pengalaman_kerja . '%');
        }
        if ($request->filled('gaji_min')) {
            $query->where('rentang_gaji', 'like', '%' . (int)$request->gaji_min . '%');
        }

        $lowongan = $query->paginate(10);

        // Data master untuk filter (dari database)
        $kategoriPekerjaan = KategoriPekerjaan::orderBy('nama_kategori')->get();
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_jenis')->get();
        $lokasiKerja = LokasiKerja::orderBy('nama_lokasi')->get();
        $tingkatPendidikanOptions = ['SMA/SMK', 'D3', 'S1', 'S2'];
        $pengalamanKerjaOptions = ['Fresh Graduate', '1-3 tahun', '>3 tahun'];


        return view('lowongan_publik.index', compact(
            'lowongan',
            'kategoriPekerjaan',
            'jenisPekerjaan',
            'lokasiKerja',
            'tingkatPendidikanOptions',
            'pengalamanKerjaOptions'
        ));
    }

    public function show(Lowongan $lowongan)
    {
        // Pastikan lowongan aktif dan belum kadaluarsa
        if ($lowongan->status_lowongan !== 'aktif' || $lowongan->batas_akhir_lamaran < now()) {
            abort(404);
        }
        return view('lowongan_publik.show', compact('lowongan'));
    }
}
