<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'jenis_usaha',
        'alamat_kantor',
        'nomor_telepon_perusahaan',
        'email_perusahaan',
        'npwp_nib',
        'nama_penanggung_jawab',
        'jabatan_penanggung_jawab',
        'logo_perusahaan',
        'deskripsi_singkat',
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // PASTIKAN RELASI INI BENAR:
    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }
}
