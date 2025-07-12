<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nik')->unique()->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('path_cv')->nullable();
            $table->string('path_foto_profil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
