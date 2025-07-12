<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Storage;

class PelamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelamarData = [
            [
                'user_email' => 'andi@example.com',
                'user_password' => 'password', // GANTI PASSWORD INI DI PRODUKSI!
                'nama_lengkap' => 'Andi Wijaya',
                'nik' => '1234567890123001',
                'tanggal_lahir' => '1995-05-10',
                'alamat_domisili' => 'Perum. Taman Raya Blok A No. 1, Batam Kota',
                'nomor_telepon' => '081234567891',
                'pendidikan' => 'S1 Teknik Informatika - Universitas Batam',
                'pengalaman_kerja' => 'Software Engineer di PT Solusi Cerdas (2020-2024)',
                'keahlian' => 'PHP, Laravel, MySQL, JavaScript, Vue.js, RESTful API, Git',
                'cv_path_dummy' => 'dummy_cvs/andi_wijaya_cv.pdf',
                'foto_profil_path_dummy' => 'dummy_photos/andi_wijaya.jpg',
            ],
            [
                'user_email' => 'sinta@example.com',
                'user_password' => 'password', // GANTI PASSWORD INI DI PRODUKSI!
                'nama_lengkap' => 'Sinta Dewi',
                'nik' => '1234567890123002',
                'tanggal_lahir' => '1998-11-22',
                'alamat_domisili' => 'Apartemen Nagoya Hill Tower B, Lubuk Baja',
                'nomor_telepon' => '081345678912',
                'pendidikan' => 'D3 Akuntansi - Politeknik Negeri Batam',
                'pengalaman_kerja' => 'Staff Administrasi di CV Jaya Abadi (2021-2023)',
                'keahlian' => 'Microsoft Office (Word, Excel, PowerPoint), Pengarsipan, Komunikasi, Data Entry',
                'cv_path_dummy' => null,
                'foto_profil_path_dummy' => null,
            ],
        ];

        // Pastikan folder dummy ada dan buat file dummy jika diperlukan
        if (!Storage::disk('public')->exists('dummy_cvs')) {
            Storage::disk('public')->makeDirectory('dummy_cvs');
            // Buat file PDF dummy
            file_put_contents(storage_path('app/public/dummy_cvs/andi_wijaya_cv.pdf'), "Ini adalah CV dummy untuk Andi Wijaya.");
        }
        if (!Storage::disk('public')->exists('dummy_photos')) {
            Storage::disk('public')->makeDirectory('dummy_photos');
            // Buat file JPG dummy (sangat kecil, hanya placeholder)
            $dummy_image = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=');
            file_put_contents(storage_path('app/public/dummy_photos/andi_wijaya.jpg'), $dummy_image);
        }

        foreach ($pelamarData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['user_email']],
                [
                    'name' => $data['nama_lengkap'],
                    'password' => Hash::make($data['user_password']),
                    'role' => 'pelamar',
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]
            );

            Pelamar::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => $data['nik'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'alamat_domisili' => $data['alamat_domisili'],
                    'nomor_telepon' => $data['nomor_telepon'],
                    'pendidikan' => $data['pendidikan'],
                    'pengalaman_kerja' => $data['pengalaman_kerja'],
                    'keahlian' => $data['keahlian'],
                    'path_cv' => $data['cv_path_dummy'],
                    'path_foto_profil' => $data['foto_profil_path_dummy'],
                ]
            );
            $this->command->info("Pelamar '{$data['nama_lengkap']}' berhasil di-seed.");
        }
    }
}
