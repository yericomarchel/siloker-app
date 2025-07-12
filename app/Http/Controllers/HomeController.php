<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil beberapa lowongan aktif terbaru untuk ditampilkan di homepage
        $lowonganTerbaru = Lowongan::with('perusahaan')
                                ->where('status_lowongan', 'aktif')
                                ->whereDate('batas_akhir_lamaran', '>=', now())
                                ->orderBy('created_at', 'desc')
                                ->take(6) // Ambil 6 lowongan terbaru
                                ->get();

        // Nomor WhatsApp Disnaker (GANTI DENGAN NOMOR ASLI DISNAKER BATAM)
        $whatsappNumber = '6281234567890'; // Contoh: Ganti dengan nomor WhatsApp Disnaker Batam

        return view('homepage', compact('lowonganTerbaru', 'whatsappNumber'));
    }
}
