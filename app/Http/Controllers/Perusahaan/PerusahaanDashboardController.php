<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\Lamaran; // <-- Tambahkan ini untuk model Lamaran
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
class PerusahaanDashboardController extends Controller
{
    public function dashboard()
    {
        // Pastikan user sudah login dan role-nya perusahaan
        if (!Auth::check() || Auth::user()->role !== 'perusahaan') {
            return redirect()->route('login'); // Atau ke dashboard umum
        }

        $user = Auth::user();
        $perusahaan = $user->perusahaan;

        // Inisialisasi variabel dengan nilai default
        $totalLowongan = 0;
        $lowonganAktif = 0;
        $lowonganMenungguPersetujuan = 0;
        $lowonganDitolak = 0;
        $lowonganTerbaru = collect(); // Menggunakan collect() untuk koleksi kosong
        $lowonganAkanKadaluarsa = collect(); // Koleksi kosong
        $lamaranTerbaru = collect(); // Koleksi kosong

        if ($perusahaan) {
            // Statistik Lowongan
            $totalLowongan = $perusahaan->lowongan()->count();
            $lowonganAktif = $perusahaan->lowongan()->where('status_lowongan', 'aktif')->count();
            $lowonganMenungguPersetujuan = $perusahaan->lowongan()->where('status_lowongan', 'menunggu_persetujuan')->count();
            $lowonganDitolak = $perusahaan->lowongan()->where('status_lowongan', 'ditolak')->count();

            // 5 Lowongan terbaru dari perusahaan ini
            $lowonganTerbaru = $perusahaan->lowongan()->orderBy('created_at', 'desc')->take(5)->get();

            // Lowongan yang akan kadaluarsa dalam 7 hari atau sudah kadaluarsa
            $lowonganAkanKadaluarsa = $perusahaan->lowongan()
                                            ->whereIn('status_lowongan', ['aktif', 'menunggu_persetujuan'])
                                            ->whereDate('batas_akhir_lamaran', '<=', Carbon::now()->addDays(7))
                                            ->orderBy('batas_akhir_lamaran', 'asc')
                                            ->get();

            // 5 Lamaran terbaru yang masuk ke lowongan perusahaan ini
            $lamaranTerbaru = Lamaran::whereHas('lowongan', function($query) use ($perusahaan) {
                                                $query->where('perusahaan_id', $perusahaan->id);
                                            })
                                            ->with(['pelamar.user', 'lowongan']) // Eager load relasi
                                            ->orderBy('created_at', 'desc')
                                            ->limit(5)
                                            ->get();

            Log::info("PerusahaanDashboardController: Dashboard loaded for Perusahaan ID: {$perusahaan->id}, Name: {$perusahaan->nama_perusahaan}");
        } else {
            Log::error("PerusahaanDashboardController: User '{$user->email}' has role 'perusahaan' but no associated Perusahaan record found. Redirecting to profile edit.");
            return redirect()->route('perusahaan.profil.edit')->with('error', 'Data profil perusahaan Anda belum lengkap. Mohon lengkapi data Anda.');
        }

        return view('perusahaan.dashboard', compact(
            'perusahaan',
            'totalLowongan',
            'lowonganAktif',
            'lowonganMenungguPersetujuan',
            'lowonganDitolak',
            'lowonganTerbaru',
            'lowonganAkanKadaluarsa', // <-- Variabel baru yang dikirim
            'lamaranTerbaru' // <-- Variabel baru yang dikirim
        ));
    }

    public function editProfile()
    {
        if (!Auth::check() || Auth::user()->role !== 'perusahaan') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $perusahaan = Auth::user()->perusahaan;

        if (!$perusahaan) {
            return redirect()->route('dashboard')->with('error', 'Data perusahaan Anda tidak ditemukan. Mohon hubungi Admin.');
        }

        return view('perusahaan.profil.edit', compact('perusahaan'));
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'perusahaan') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $user = Auth::user();
        $perusahaan = $user->perusahaan;

        if (!$perusahaan) {
             return redirect()->route('dashboard')->with('error', 'Gagal memperbarui: Data perusahaan Anda tidak ditemukan.');
        }

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'nomor_telepon_perusahaan' => 'nullable|string|max:20',
            'email_perusahaan' => ['required', 'string', 'email', 'max:255', Rule::unique('perusahaan', 'email_perusahaan')->ignore($perusahaan->id)],
            'npwp_nib' => ['nullable', 'string', 'max:255', Rule::unique('perusahaan', 'npwp_nib')->ignore($perusahaan->id)],
            'nama_penanggung_jawab' => 'nullable|string|max:255',
            'jabatan_penanggung_jawab' => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo_perusahaan')) {
            if ($perusahaan->logo_perusahaan && Storage::disk('public')->exists($perusahaan->logo_perusahaan)) {
                Storage::disk('public')->delete($perusahaan->logo_perusahaan);
            }
            $path = $request->file('logo_perusahaan')->store('logos', 'public');
            $perusahaan->logo_perusahaan = $path;
        }

        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_kantor' => $request->alamat_kantor,
            'nomor_telepon_perusahaan' => $request->nomor_telepon_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'npwp_nib' => $request->npwp_nib,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            'deskripsi_singkat' => $request->deskripsi_singkat,
        ]);

        $user->name = $request->nama_perusahaan;
        $user->save();

        return redirect()->route('perusahaan.dashboard')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
