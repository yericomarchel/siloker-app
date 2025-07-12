<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel perusahaan (bukan user_id langsung)
            $table->foreignId('perusahaan_id')->constrained('perusahaan')->onDelete('cascade');
            $table->string('judul_lowongan');
            $table->string('kategori_pekerjaan');
            $table->enum('jenis_pekerjaan', ['Full-time', 'Part-time', 'Freelance', 'Magang', 'Kontrak']);
            $table->string('lokasi_kerja');
            $table->text('deskripsi_pekerjaan');
            $table->text('kualifikasi_pelamar');
            $table->string('rentang_gaji')->nullable();
            $table->date('batas_akhir_lamaran');
            $table->enum('status_lowongan', ['menunggu_persetujuan', 'aktif', 'ditolak', 'kadaluarsa'])->default('menunggu_persetujuan');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
