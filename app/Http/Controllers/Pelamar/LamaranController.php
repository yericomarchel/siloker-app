<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    /**
     * Menyimpan lamaran pekerjaan baru oleh pelamar.
     */
    public function store(Request $request)
    {
        // Validasi input: pastikan lowongan_id ada di tabel lowongan
        $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id',
        ]);

        $user = Auth::user();
        $pelamar = $user->pelamar; // Dapatkan objek Pelamar yang terkait dengan user

        // Pastikan pelamar ada dan profilnya lengkap sebelum melamar
        if (!$pelamar || !$pelamar->isProfileComplete()) {
            return redirect()->route('pelamar.profil.edit')->with('error', 'Anda harus melengkapi profil terlebih dahulu sebelum melamar pekerjaan.');
        }

        $lowonganId = $request->lowongan_id;
        $lowongan = Lowongan::find($lowonganId); // Ambil objek Lowongan

        // Cek kembali jika lowongan tidak ditemukan (meskipun sudah divalidasi exists)
        if (!$lowongan) {
            return back()->with('error', 'Lowongan tidak ditemukan.');
        }

        // Cek apakah pelamar sudah melamar lowongan ini sebelumnya
        $existingLamaran = Lamaran::where('pelamar_id', $pelamar->id)
                                  ->where('lowongan_id', $lowonganId)
                                  ->first();

        if ($existingLamaran) {
            return back()->with('info', 'Anda sudah melamar pekerjaan ini.'); // Gunakan 'info' untuk pesan non-error
        }

        // Buat entri lamaran baru di database
        Lamaran::create([
            'pelamar_id' => $pelamar->id,
            'lowongan_id' => $lowonganId,
            'status_lamaran' => 'menunggu', // Status default saat pelamar melamar
        ]);

        return redirect()->route('pelamar.lamaran.index')->with('success', 'Lamaran Anda berhasil dikirim. Silakan tunggu review dari perusahaan.');
    }

    /**
     * Menampilkan daftar riwayat lamaran yang diajukan oleh pelamar yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user->pelamar; // Dapatkan objek Pelamar yang terkait dengan user

        // Jika objek pelamar belum ada (misal: user baru register dan belum melengkapi profil),
        // tampilkan riwayat kosong dan peringatan.
        if (!$pelamar) {
            return view('pelamar.lamaran.index', ['lamaran' => collect()])->with('warning', 'Anda belum memiliki riwayat lamaran karena profil belum lengkap.');
        }

        // Ambil semua lamaran yang terkait dengan pelamar ini, beserta lowongan dan perusahaan terkait.
        $lamaran = Lamaran::with('lowongan.perusahaan')
                          ->where('pelamar_id', $pelamar->id)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('pelamar.lamaran.index', compact('lamaran'));
    }
}
