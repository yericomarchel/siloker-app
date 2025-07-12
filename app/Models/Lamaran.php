<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'lamaran';

    // Kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'pelamar_id',
        'lowongan_id',
        'status_lamaran', // Enum: menunggu, dilihat, dalam_proses, diterima, ditolak
    ];

    // Relasi dengan model Pelamar (satu lamaran dibuat oleh satu pelamar)
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    // Relasi dengan model Lowongan (satu lamaran untuk satu lowongan)
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
