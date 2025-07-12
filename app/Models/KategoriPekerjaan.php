<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'kategori_pekerjaan';

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = ['nama_kategori'];
}
