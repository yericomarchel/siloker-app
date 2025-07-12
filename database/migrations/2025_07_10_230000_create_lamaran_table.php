<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamar')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongan')->onDelete('cascade');
            $table->enum('status_lamaran', ['menunggu', 'dilihat', 'dalam_proses', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();
            $table->unique(['pelamar_id', 'lowongan_id']); // Mencegah duplikasi lamaran
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};
