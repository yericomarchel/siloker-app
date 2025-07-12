<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPelamar = User::where('role', 'pelamar')->count();
        $totalPerusahaan = Perusahaan::count();
        $totalLowonganAktif = Lowongan::where('status_lowongan', 'aktif')->count();
        $totalLowonganMenunggu = Lowongan::where('status_lowongan', 'menunggu_persetujuan')->count();

        return view('admin.dashboard', compact('totalPelamar', 'totalPerusahaan', 'totalLowonganAktif', 'totalLowonganMenunggu'));
    }
}
