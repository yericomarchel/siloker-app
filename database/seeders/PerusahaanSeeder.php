<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaanData = [
            [
                'user_email' => 'ptbatamjaya@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'PT Batam Jaya Logistik',
                'jenis_usaha' => 'Logistik & Transportasi',
                'alamat_kantor' => 'Kawasan Industri Batamindo, Blok A1, Batam Kota',
                'nomor_telepon_perusahaan' => '0778111222',
                'email_perusahaan' => 'info@ptbatamjaya.com',
                'npwp_nib' => '111222333444555',
                'nama_penanggung_jawab' => 'Agus Salim',
                'jabatan_penanggung_jawab' => 'Direktur Utama',
                'deskripsi_singkat' => 'Penyedia layanan logistik terintegrasi dan solusi rantai pasok terkemuka di Batam.',
            ],
            [
                'user_email' => 'ptglobal@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'PT Global Elektronik Nusantara',
                'jenis_usaha' => 'Manufaktur Elektronik',
                'alamat_kantor' => 'Batamindo Industrial Park, Jl. Engku Putri No. 1, Batam Center',
                'nomor_telepon_perusahaan' => '0778444555',
                'email_perusahaan' => 'hrd@globalelektronik.com',
                'npwp_nib' => '666777888999000',
                'nama_penanggung_jawab' => 'Fatmawati Dewi',
                'jabatan_penanggung_jawab' => 'Manajer HRD',
                'deskripsi_singkat' => 'Produsen komponen elektronik presisi tinggi dan perakitan perangkat IoT.',
            ],
            [
                'user_email' => 'cvprima@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'CV Prima Konsultan',
                'jenis_usaha' => 'Jasa Konsultan Bisnis & IT',
                'alamat_kantor' => 'Komplek Ruko Greenland Blok C, Batam Center',
                'nomor_telepon_perusahaan' => '0778777888',
                'email_perusahaan' => 'admin@primakonsultan.com',
                'npwp_nib' => '123987654321000',
                'nama_penanggung_jawab' => 'Rina Wijaya',
                'jabatan_penanggung_jawab' => 'Konsultan Senior',
                'deskripsi_singkat' => 'Menyediakan layanan konsultasi untuk pengembangan UMKM dan startup teknologi di Batam.',
            ],
            [
                'user_email' => 'ptcahayabaru@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'PT Cahaya Baru Konstruksi',
                'jenis_usaha' => 'Konstruksi & Properti',
                'alamat_kantor' => 'Jl. Raja Haji Fisabilillah, Belian, Nongsa',
                'nomor_telepon_perusahaan' => '0778222333',
                'email_perusahaan' => 'info@cahayabaru.com',
                'npwp_nib' => '998877665544333',
                'nama_penanggung_jawab' => 'Hartono Kusuma',
                'jabatan_penanggung_jawab' => 'Direktur Proyek',
                'deskripsi_singkat' => 'Pengembang properti dan kontraktor bangunan terkemuka di Batam.',
            ],
            [
                'user_email' => 'ptsamudera@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'PT Samudera Bahari Logistik',
                'jenis_usaha' => 'Transportasi Laut & Perikanan',
                'alamat_kantor' => 'Pelabuhan Batu Ampar, Batam',
                'nomor_telepon_perusahaan' => '0778555666',
                'email_perusahaan' => 'ops@samudera.com',
                'npwp_nib' => '123123123123123',
                'nama_penanggung_jawab' => 'Andi Putra',
                'jabatan_penanggung_jawab' => 'Manajer Operasional',
                'deskripsi_singkat' => 'Spesialis dalam angkutan laut dan distribusi hasil perikanan.',
            ],
            [
                'user_email' => 'hotelindah@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'Hotel Indah Permai Batam',
                'jenis_usaha' => 'Hospitality & Pariwisata',
                'alamat_kantor' => 'Jl. Imam Bonjol No. 10, Nagoya',
                'nomor_telepon_perusahaan' => '0778888999',
                'email_perusahaan' => 'reservasi@hotelindah.com',
                'npwp_nib' => '456456456456456',
                'nama_penanggung_jawab' => 'Dewi Lestari',
                'jabatan_penanggung_jawab' => 'General Manager',
                'deskripsi_singkat' => 'Hotel bintang empat dengan fasilitas lengkap di pusat kota Nagoya.',
            ],
            [
                'user_email' => 'batamdigital@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'Batam Digital Kreatif',
                'jenis_usaha' => 'Media & Periklanan Digital',
                'alamat_kantor' => 'Ruko Center Point, Sei Beduk',
                'nomor_telepon_perusahaan' => '0778100100',
                'email_perusahaan' => 'contact@batamdigital.com',
                'npwp_nib' => '789789789789789',
                'nama_penanggung_jawab' => 'Rio Firmansyah',
                'jabatan_penanggung_jawab' => 'Creative Director',
                'deskripsi_singkat' => 'Agensi kreatif yang berfokus pada pemasaran digital dan branding.',
            ],
            [
                'user_email' => 'ptsentosa@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'PT Sentosa Manufaktur Global',
                'jenis_usaha' => 'Manufaktur Umum',
                'alamat_kantor' => 'Kawasan Industri Mukakuning, Sagulung',
                'nomor_telepon_perusahaan' => '0778999000',
                'email_perusahaan' => 'info@sentosamanufaktur.com',
                'npwp_nib' => '321321321321321',
                'nama_penanggung_jawab' => 'Slamet Widodo',
                'jabatan_penanggung_jawab' => 'Manajer Produksi',
                'deskripsi_singkat' => 'Spesialis dalam produksi berbagai komponen dan perakitan produk sesuai pesanan.',
            ],
            [
                'user_email' => 'rsmedika@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'RS Medika Batam',
                'jenis_usaha' => 'Kesehatan',
                'alamat_kantor' => 'Jl. Pahlawan No. 50, Batu Ampar',
                'nomor_telepon_perusahaan' => '0778000111',
                'email_perusahaan' => 'hr@rsmedika.com',
                'npwp_nib' => '987654321098765',
                'nama_penanggung_jawab' => 'Dr. Budiarto',
                'jabatan_penanggung_jawab' => 'Direktur Medis',
                'deskripsi_singkat' => 'Rumah sakit modern dengan fasilitas lengkap dan tim medis profesional.',
            ],
            [
                'user_email' => 'batamretail@example.com',
                'user_password' => 'password',
                'nama_perusahaan' => 'Batam Retail Solutions',
                'jenis_usaha' => 'Perdagangan & Retail',
                'alamat_kantor' => 'Mega Mall Batam Center, Lantai 3, Batam Center',
                'nomor_telepon_perusahaan' => '0778303030',
                'email_perusahaan' => 'marketing@batamretail.com',
                'npwp_nib' => '555666777888999',
                'nama_penanggung_jawab' => 'Lisa Handayani',
                'jabatan_penanggung_jawab' => 'Manajer Pemasaran',
                'deskripsi_singkat' => 'Penyedia solusi retail modern dan manajemen toko di Batam.',
            ],
        ];

        foreach ($perusahaanData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['user_email']],
                [
                    'name' => $data['nama_perusahaan'],
                    'password' => Hash::make($data['user_password']),
                    'role' => 'perusahaan',
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]
            );

            Perusahaan::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_perusahaan' => $data['nama_perusahaan'],
                    'jenis_usaha' => $data['jenis_usaha'],
                    'alamat_kantor' => $data['alamat_kantor'],
                    'nomor_telepon_perusahaan' => $data['nomor_telepon_perusahaan'],
                    'email_perusahaan' => $data['email_perusahaan'],
                    'npwp_nib' => $data['npwp_nib'],
                    'nama_penanggung_jawab' => $data['nama_penanggung_jawab'],
                    'jabatan_penanggung_jawab' => $data['jabatan_penanggung_jawab'],
                    'deskripsi_singkat' => $data['deskripsi_singkat'],
                    'is_aktif' => true,
                ]
            );
            $this->command->info("Perusahaan '{$data['nama_perusahaan']}' berhasil di-seed.");
        }
    }
}
