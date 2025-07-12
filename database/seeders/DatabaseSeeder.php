<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Tidak perlu lagi import Models di DatabaseSeeder, cukup panggil seedernya
// use App\Models\Lowongan;
// use App\Models\Perusahaan;
// use App\Models\KategoriPekerjaan;
// use App\Models\JenisPekerjaan;
// use App\Models\LokasiKerja;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            PerusahaanSeeder::class,
            PelamarSeeder::class,
            KategoriPekerjaanSeeder::class,
            JenisPekerjaanSeeder::class,
            LokasiKerjaSeeder::class,
            LowonganSeeder::class, // Panggil seeder lowongan dummy
        ]);
    }
}
