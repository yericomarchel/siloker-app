<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\JenisPekerjaan;
class JenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisData = [
            'Full-time', 'Part-time', 'Freelance', 'Magang', 'Kontrak',
        ];
        foreach ($jenisData as $nama) {
            JenisPekerjaan::firstOrCreate(['nama_jenis' => $nama]);
        }
        $this->command->info('Jenis Pekerjaan berhasil di-seed.');
    }
}
