<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Perusahaan; // Pastikan ini diimpor
use App\Models\Pelamar;    // Pastikan ini diimpor jika diperlukan relasi langsung
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // <-- Pastikan ini ada untuk logging

class LamaranPerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perusahaan = $user->perusahaan; // Dapatkan objek Perusahaan yang login

        // --- DEBUGGING: Log keberadaan objek perusahaan ---
        if (!$perusahaan) {
            Log::error('LamaranPerusahaanController@index: Objek Perusahaan tidak ditemukan untuk user ID: ' . $user->id . ', Email: ' . $user->email);
            // Redirect ke dashboard atau tampilkan pesan error yang jelas
            return redirect()->route('perusahaan.dashboard')->with('error', 'Profil perusahaan Anda tidak ditemukan. Mohon lengkapi atau hubungi Admin.');
        }
        Log::info('LamaranPerusahaanController@index: Akses Manajemen Lamaran oleh Perusahaan ID: ' . $perusahaan->id . ' Name: ' . $perusahaan->nama_perusahaan);
        // --- END DEBUGGING ---


        // Ambil semua lowongan yang dimiliki oleh perusahaan ini
        // Ini adalah sumber data untuk dropdown filter dan dasar query lamaran
        $lowonganPerusahaan = $perusahaan->lowongan()->get();
        Log::info('LamaranPerusahaanController@index: Jumlah Lowongan Perusahaan yang ditemukan: ' . $lowonganPerusahaan->count());


        // Ambil ID-ID lowongan dari perusahaan ini
        $lowonganIds = $lowonganPerusahaan->pluck('id');

        // Query dasar untuk lamaran yang terkait dengan lowongan perusahaan ini
        $query = Lamaran::whereIn('lowongan_id', $lowonganIds)
                        ->with(['pelamar.user', 'lowongan']) // Eager load pelamar.user dan lowongan
                        ->orderBy('created_at', 'desc');

        // Filter berdasarkan status lamaran
        if ($request->filled('status')) {
            $query->where('status_lamaran', $request->status);
            Log::info('LamaranPerusahaanController@index: Filter Status: ' . $request->status);
        }

        // Filter berdasarkan ID lowongan (dari dropdown)
        if ($request->filled('lowongan_id')) {
            $query->where('lowongan_id', $request->lowongan_id);
            Log::info('LamaranPerusahaanController@index: Filter Lowongan ID: ' . $request->lowongan_id);
        }

        // Filter berdasarkan nama pelamar (keyword)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->whereHas('pelamar.user', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
            Log::info('LamaranPerusahaanController@index: Filter Keyword Pelamar: ' . $keyword);
        }

        $lamaran = $query->paginate(10);
        Log::info('LamaranPerusahaanController@index: Jumlah Lamaran yang ditemukan setelah filter: ' . $lamaran->total());

        // Variabel $lowonganPerusahaan memang harus dikirim ke view untuk dropdown filter
        return view('perusahaan.lamaran.index', compact('lamaran', 'lowonganPerusahaan'));
    }

    /**
     * Menampilkan detail lamaran tertentu.
     */
    public function show(Lamaran $lamaran)
    {
        // Pastikan lamaran ini milik lowongan perusahaan yang sedang login
        // Ambil ID perusahaan yang login dari objek Perusahaan
        $perusahaanLoginId = Auth::user()->perusahaan->id;

        if ($lamaran->lowongan->perusahaan_id !== $perusahaanLoginId) {
            abort(403, 'Anda tidak memiliki akses ke lamaran ini.');
        }

        // Load relasi yang dibutuhkan: pelamar dan user dari pelamar
        $lamaran->load('pelamar.user');

        // Daftar status yang tersedia untuk dropdown
        $statuses = ['menunggu', 'dilihat', 'dalam_proses', 'diterima', 'ditolak']; // Sesuaikan dengan enum di migrasi Lamaran

        return view('perusahaan.lamaran.show', compact('lamaran', 'statuses'));
    }

    /**
     * Mengubah status lamaran.
     */
    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:menunggu,dilihat,dalam_proses,diterima,ditolak', // Sesuaikan dengan enum di migrasi Lamaran
        ]);

        // Pastikan lamaran ini milik lowongan perusahaan yang sedang login
        $perusahaanLoginId = Auth::user()->perusahaan->id;
        if ($lamaran->lowongan->perusahaan_id !== $perusahaanLoginId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah status lamaran ini.');
        }

        $lamaran->status_lamaran = $request->status; // Perhatikan: ini harus 'status_lamaran' sesuai migrasi Lamaran
        $lamaran->save();

        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst(str_replace('_', ' ', $request->status)) . '.');
    }

    /**
     * Mengunduh CV pelamar.
     */
    public function downloadCv(Lamaran $lamaran)
    {
        // Pastikan lamaran ini milik lowongan perusahaan yang sedang login
        $perusahaanLoginId = Auth::user()->perusahaan->id;
        if ($lamaran->lowongan->perusahaan_id !== $perusahaanLoginId) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh CV ini.');
        }

        $pelamar = $lamaran->pelamar;

        if ($pelamar && $pelamar->path_cv) { // Gunakan 'path_cv' sesuai model Pelamar
            $filePath = $pelamar->path_cv;

            if (Storage::disk('public')->exists($filePath)) {
                // Pastikan nama file yang didownload mudah dikenali
                $fileName = 'CV_' . ($pelamar->user->name ?? 'Pelamar') . '_' . $lamaran->lowongan->judul_lowongan . '.pdf';
                return Storage::disk('public')->download($filePath, $fileName);
            }
        }

        return redirect()->back()->with('error', 'CV pelamar tidak ditemukan.');
    }
}
