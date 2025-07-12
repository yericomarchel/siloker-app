<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\KategoriPekerjaan;
class KategoriPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            'IT', 'Manufaktur', 'Retail', 'Hospitality', 'Pendidikan', 'Keuangan',
            'Konstruksi', 'Logistik', 'Kesehatan', 'Pemasaran', 'Administrasi', 'Transportasi',
        ];
        foreach ($kategoriData as $nama) {
            KategoriPekerjaan::firstOrCreate(['nama_kategori' => $nama]);
        }
        $this->command->info('Kategori Pekerjaan berhasil di-seed.');
    }
}
