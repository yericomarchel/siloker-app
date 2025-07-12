<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import model Data Master (PASTIKAN SEMUA INI ADA)
use App\Models\KategoriPekerjaan;
use App\Models\JenisPekerjaan;
use App\Models\LokasiKerja;


class LowonganPelamarController extends Controller // PASTIKAN NAMA KELAS INI SESUAI DENGAN NAMA FILE
{
    public function index(Request $request)
    {
        // Mendapatkan objek User yang sedang login
        $user = Auth::user();
        // Mendapatkan objek Pelamar, bisa null jika user bukan pelamar atau data pelamar belum dibuat
        $pelamar = null;
        if ($user && $user->role === 'pelamar') {
            $pelamar = $user->pelamar;
        }

        // Query lowongan aktif
        $query = Lowongan::with('perusahaan')
                         ->where('status_lowongan', 'aktif')
                         ->whereDate('batas_akhir_lamaran', '>=', now()) // Hanya lowongan yang belum kadaluarsa
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
            // Logika sederhana untuk gaji, akan mencari string yang mengandung angka tsb
            // Ini bisa diperbaiki lebih lanjut jika rentang gaji disimpan dalam format yang lebih terstruktur (misal: kolom min_gaji, max_gaji numerik)
            $query->where('rentang_gaji', 'like', '%' . (int)$request->gaji_min . '%');
        }

        $lowongan = $query->paginate(10);

        // Pastikan pengambilan data master ini ada dan benar:
        $kategoriPekerjaan = KategoriPekerjaan::orderBy('nama_kategori')->get();
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_jenis')->get();
        $lokasiKerja = LokasiKerja::orderBy('nama_lokasi')->get();

        // Opsi statis untuk pendidikan dan pengalaman
        $tingkatPendidikanOptions = ['SMA/SMK', 'D3', 'S1', 'S2', 'S3']; // Menambahkan S3
        $pengalamanKerjaOptions = ['Fresh Graduate', '< 1 Tahun', '1-3 Tahun', '3-5 Tahun', '> 5 Tahun']; // Lebih rinci

        // Ambil ID lowongan yang sudah dilamar oleh pelamar ini
        $lowonganYangSudahDilamarIds = [];
        if ($pelamar) { // Hanya jika objek pelamar ada
            $lowonganYangSudahDilamarIds = $pelamar->lamaran()->pluck('lowongan_id')->toArray();
        }

        // Pastikan semua variabel ini dikirimkan ke view:
        return view('pelamar.lowongan.index', compact(
            'lowongan',
            'pelamar', // Variabel pelamar masih dikirimkan, bisa null jika tidak login/bukan pelamar
            'lowonganYangSudahDilamarIds',
            'kategoriPekerjaan',
            'jenisPekerjaan',
            'lokasiKerja',
            'tingkatPendidikanOptions',
            'pengalamanKerjaOptions'
        ));
    }

    public function show(Lowongan $lowongan)
    {
        $user = Auth::user();
        $pelamar = null;
        if ($user && $user->role === 'pelamar') {
            $pelamar = $user->pelamar;
        }

        // Cek apakah pelamar sudah melamar lowongan ini
        $sudahMelamar = false;
        if ($pelamar) { // Hanya jika objek pelamar ada
            $sudahMelamar = Lamaran::where('pelamar_id', $pelamar->id)
                                    ->where('lowongan_id', $lowongan->id)
                                    ->exists();
        }

        // Cek apakah profil pelamar lengkap
        // $pelamar bisa null jika user belum login atau bukan pelamar
        $isProfileComplete = ($pelamar && $pelamar->isProfileComplete());

        // Variabel $isSaved telah dihapus total dari fitur, jadi tidak perlu lagi dicek atau dikirim ke view

        return view('pelamar.lowongan.show', compact('lowongan', 'sudahMelamar', 'isProfileComplete'));
    }

    // Metode saveLowongan(), unsaveLowongan(), dan savedLowonganIndex()
    // sudah dihapus sepenuhnya dari controller ini
}
