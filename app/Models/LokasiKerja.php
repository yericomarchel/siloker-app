<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKerja extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'lokasi_kerja';

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = ['nama_lokasi'];
}
