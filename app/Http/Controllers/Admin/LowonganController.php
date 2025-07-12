<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::with('perusahaan')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lowongan.index', compact('lowongan'));
    }

    public function show(Lowongan $lowongan)
    {
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function approve(Lowongan $lowongan)
    {
        $lowongan->update(['status_lowongan' => 'aktif']);
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil disetujui.');
    }

    public function reject(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500',
        ]);

        $lowongan->update([
            'status_lowongan' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditolak.');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}
