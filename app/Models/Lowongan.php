<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'lowongan';

    // Kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'perusahaan_id', // Foreign key ke tabel 'perusahaan'
        'judul_lowongan',
        'kategori_pekerjaan',
        'jenis_pekerjaan',
        'lokasi_kerja',
        'deskripsi_pekerjaan',
        'kualifikasi_pelamar',
        'rentang_gaji',
        'batas_akhir_lamaran',
        'status_lowongan', // Enum: menunggu_persetujuan, aktif, ditolak, kadaluarsa
        'alasan_penolakan',
    ];

    // Kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'batas_akhir_lamaran' => 'date',
    ];

    // Relasi dengan model Perusahaan (satu lowongan dimiliki oleh satu perusahaan)
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    // Relasi dengan model Lamaran (satu lowongan punya banyak lamaran)
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
    }
}
