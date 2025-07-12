<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'pelamar';

    // Kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'user_id',
        'nik',
        'tanggal_lahir',
        'alamat_domisili',
        'nomor_telepon',
        'pendidikan',
        'pengalaman_kerja',
        'keahlian',
        'path_cv',
        'path_foto_profil',
    ];

    // Relasi dengan model User (untuk akun pelamar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke lamaran yang dibuat oleh pelamar ini
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
    }

    /**
     * Cek apakah profil pelamar sudah lengkap untuk melamar.
     * Mengembalikan true jika semua kolom penting terisi.
     */
    public function isProfileComplete()
    {
        return $this->nik !== null &&
               $this->tanggal_lahir !== null &&
               $this->alamat_domisili !== null &&
               $this->nomor_telepon !== null &&
               $this->pendidikan !== null &&
               $this->pengalaman_kerja !== null &&
               $this->keahlian !== null &&
               $this->path_cv !== null; // CV wajib untuk kelengkapan profil
    }
}
