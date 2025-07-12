<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|string|email|max:255|unique:perusahaan,email_perusahaan',
            'npwp_nib' => 'nullable|string|max:255|unique:perusahaan,npwp_nib',
            'jenis_usaha' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'nomor_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_penanggung_jawab' => 'nullable|string|max:255',
            'jabatan_penanggung_jawab' => 'nullable|string|max:255',
            'email_login' => 'required|string|email|max:255|unique:users,email',
            'password_login' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->nama_perusahaan,
            'email' => $request->email_login,
            'password' => Hash::make($request->password_login),
            'role' => 'perusahaan',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        Perusahaan::create([
            'user_id' => $user->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_kantor' => $request->alamat_kantor,
            'nomor_telepon_perusahaan' => $request->nomor_telepon_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'npwp_nib' => $request->npwp_nib,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            'is_aktif' => true,
        ]);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function show(Perusahaan $perusahaan)
    {
        return view('admin.perusahaan.show', compact('perusahaan'));
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => ['required', 'string', 'email', 'max:255', Rule::unique('perusahaan', 'email_perusahaan')->ignore($perusahaan->id)],
            'npwp_nib' => ['nullable', 'string', 'max:255', Rule::unique('perusahaan', 'npwp_nib')->ignore($perusahaan->id)],
            'jenis_usaha' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'nomor_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_penanggung_jawab' => 'nullable|string|max:255',
            'jabatan_penanggung_jawab' => 'nullable|string|max:255',
            'email_login' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($perusahaan->user->id)],
            'password_login' => 'nullable|string|min:8',
        ]);

        $user = $perusahaan->user;
        $user->name = $request->nama_perusahaan;
        $user->email = $request->email_login;
        if ($request->filled('password_login')) {
            $user->password = Hash::make($request->password_login);
        }
        $user->save();

        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_kantor' => $request->alamat_kantor,
            'nomor_telepon_perusahaan' => $request->nomor_telepon_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'npwp_nib' => $request->npwp_nib,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
        ]);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui.');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->user->delete();
        return redirect()->route('admin.perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }

    public function toggleStatus(Perusahaan $perusahaan)
    {
        $perusahaan->update(['is_aktif' => !$perusahaan->is_aktif]);
        $perusahaan->user->update(['is_active' => !$perusahaan->user->is_active]);

        return back()->with('success', 'Status perusahaan berhasil diperbarui.');
    }
}
