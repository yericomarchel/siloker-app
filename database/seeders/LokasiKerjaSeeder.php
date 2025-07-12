<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LokasiKerja;
class LokasiKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasiData = [
            'Batam Kota', 'Batu Ampar', 'Nongsa', 'Sekupang', 'Sagulung', 'Lubuk Baja',
            'Nagoya', 'Belakang Padang', 'Batam Center', 'Sei Beduk', 'Galang', 'Bulang',
        ];
        foreach ($lokasiData as $nama) {
            LokasiKerja::firstOrCreate(['nama_lokasi' => $nama]);
        }
        $this->command->info('Lokasi Kerja berhasil di-seed.');
    }
}
