<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->string('jenis_usaha')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->string('nomor_telepon_perusahaan')->nullable();
            $table->string('email_perusahaan')->unique();
            $table->string('npwp_nib')->unique()->nullable();
            $table->string('nama_penanggung_jawab')->nullable();
            $table->string('jabatan_penanggung_jawab')->nullable();
            $table->string('logo_perusahaan')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
