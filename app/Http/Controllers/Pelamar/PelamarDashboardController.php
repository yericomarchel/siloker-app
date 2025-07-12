<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PelamarDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;

        // Jika pelamar belum punya data profil di tabel 'pelamar', buatkan entri kosong
        if (!$pelamar) {
            $pelamar = Pelamar::create(['user_id' => $user->id]);
        }

        // Hitung kelengkapan profil
        $completedFields = 0;
        $totalFields = 8; // NIK, tanggal_lahir, alamat_domisili, nomor_telepon, pendidikan, pengalaman_kerja, keahlian, path_cv

        if ($pelamar->nik) $completedFields++;
        if ($pelamar->tanggal_lahir) $completedFields++;
        if ($pelamar->alamat_domisili) $completedFields++;
        if ($pelamar->nomor_telepon) $completedFields++;
        if ($pelamar->pendidikan) $completedFields++;
        if ($pelamar->pengalaman_kerja) $completedFields++;
        if ($pelamar->keahlian) $completedFields++;
        if ($pelamar->path_cv) $completedFields++; // Asumsi CV adalah wajib

        $profileCompletion = ($totalFields > 0) ? round(($completedFields / $totalFields) * 100) : 0;
        $isProfileComplete = ($profileCompletion === 100);

        $jumlahLamaranTerkirim = $pelamar->lamaran()->count();

        return view('pelamar.dashboard', compact('pelamar', 'isProfileComplete', 'jumlahLamaranTerkirim', 'profileCompletion'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;

        if (!$pelamar) {
            $pelamar = Pelamar::create(['user_id' => $user->id]);
        }

        return view('pelamar.profil.edit', compact('pelamar'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $pelamar = $user->pelamar;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nik' => ['required', 'string', 'digits:16', Rule::unique('pelamar')->ignore($pelamar->id)],
            'tanggal_lahir' => 'required|date',
            'alamat_domisili' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'pendidikan' => 'required|string',
            'pengalaman_kerja' => 'required|string',
            'keahlian' => 'required|string',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->hasFile('cv_file')) {
            if ($pelamar->path_cv && Storage::disk('public')->exists($pelamar->path_cv)) {
                Storage::disk('public')->delete($pelamar->path_cv);
            }
            $cvPath = $request->file('cv_file')->store('cvs', 'public');
            $pelamar->path_cv = $cvPath;
        }

        if ($request->hasFile('foto_profil')) {
            if ($pelamar->path_foto_profil && Storage::disk('public')->exists($pelamar->path_foto_profil)) {
                Storage::disk('public')->delete($pelamar->path_foto_profil);
            }
            $fotoPath = $request->file('foto_profil')->store('profile_photos', 'public');
            $pelamar->path_foto_profil = $fotoPath;
        }

        $pelamar->update([
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat_domisili' => $request->alamat_domisili,
            'nomor_telepon' => $request->nomor_telepon,
            'pendidikan' => $request->pendidikan,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'keahlian' => $request->keahlian,
        ]);

        return redirect()->route('pelamar.dashboard')->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
