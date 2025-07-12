<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan; // Pastikan ini diimpor
use App\Models\JenisPekerjaan;     // Pastikan ini diimpor
use App\Models\LokasiKerja;       // Pastikan ini diimpor
use Carbon\Carbon;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaan = [
            'PT Batam Jaya Logistik' => Perusahaan::where('nama_perusahaan', 'PT Batam Jaya Logistik')->first(),
            'PT Global Elektronik Nusantara' => Perusahaan::where('nama_perusahaan', 'PT Global Elektronik Nusantara')->first(),
            'CV Prima Konsultan' => Perusahaan::where('nama_perusahaan', 'CV Prima Konsultan')->first(),
            'PT Cahaya Baru Konstruksi' => Perusahaan::where('nama_perusahaan', 'PT Cahaya Baru Konstruksi')->first(),
            'PT Samudera Bahari Logistik' => Perusahaan::where('nama_perusahaan', 'PT Samudera Bahari Logistik')->first(),
            'Hotel Indah Permai Batam' => Perusahaan::where('nama_perusahaan', 'Hotel Indah Permai Batam')->first(),
            'Batam Digital Kreatif' => Perusahaan::where('nama_perusahaan', 'Batam Digital Kreatif')->first(),
            'PT Sentosa Manufaktur Global' => Perusahaan::where('nama_perusahaan', 'PT Sentosa Manufaktur Global')->first(),
            'RS Medika Batam' => Perusahaan::where('nama_perusahaan', 'RS Medika Batam')->first(),
            'Batam Retail Solutions' => Perusahaan::where('nama_perusahaan', 'Batam Retail Solutions')->first(),
        ];

        // Pastikan kategori, jenis, dan lokasi ada di database atau tambahkan di seeder masing-masing
        $kategoriIT = KategoriPekerjaan::where('nama_kategori', 'IT')->first()->nama_kategori ?? 'IT';
        $kategoriManufaktur = KategoriPekerjaan::where('nama_kategori', 'Manufaktur')->first()->nama_kategori ?? 'Manufaktur';
        $kategoriPemasaran = KategoriPekerjaan::where('nama_kategori', 'Pemasaran')->first()->nama_kategori ?? 'Pemasaran';
        $kategoriAdministrasi = KategoriPekerjaan::where('nama_kategori', 'Administrasi')->first()->nama_kategori ?? 'Administrasi';
        $kategoriLogistik = KategoriPekerjaan::where('nama_kategori', 'Logistik')->first()->nama_kategori ?? 'Logistik';
        $kategoriKesehatan = KategoriPekerjaan::where('nama_kategori', 'Kesehatan')->first()->nama_kategori ?? 'Kesehatan';
        $kategoriKeuangan = KategoriPekerjaan::where('nama_kategori', 'Keuangan')->first()->nama_kategori ?? 'Keuangan';
        $kategoriKonstruksi = KategoriPekerjaan::where('nama_kategori', 'Konstruksi')->first()->nama_kategori ?? 'Konstruksi';
        $kategoriRetail = KategoriPekerjaan::where('nama_kategori', 'Retail')->first()->nama_kategori ?? 'Retail';
        $kategoriHospitality = KategoriPekerjaan::where('nama_kategori', 'Hospitality')->first()->nama_kategori ?? 'Hospitality';


        $jenisFulltime = JenisPekerjaan::where('nama_jenis', 'Full-time')->first()->nama_jenis ?? 'Full-time';
        $jenisKontrak = JenisPekerjaan::where('nama_jenis', 'Kontrak')->first()->nama_jenis ?? 'Kontrak';
        $jenisMagang = JenisPekerjaan::where('nama_jenis', 'Magang')->first()->nama_jenis ?? 'Magang';
        $jenisFreelance = JenisPekerjaan::where('nama_jenis', 'Freelance')->first()->nama_jenis ?? 'Freelance';

        $lokasiBatamKota = LokasiKerja::where('nama_lokasi', 'Batam Kota')->first()->nama_lokasi ?? 'Batam Kota';
        $lokasiBatuAmpar = LokasiKerja::where('nama_lokasi', 'Batu Ampar')->first()->nama_lokasi ?? 'Batu Ampar';
        $lokasiNagoya = LokasiKerja::where('nama_lokasi', 'Nagoya')->first()->nama_lokasi ?? 'Nagoya';
        $lokasiBatamCenter = LokasiKerja::where('nama_lokasi', 'Batam Center')->first()->nama_lokasi ?? 'Batam Center';
        $lokasiNongsa = LokasiKerja::where('nama_lokasi', 'Nongsa')->first()->nama_lokasi ?? 'Nongsa';
        $lokasiSagulung = LokasiKerja::where('nama_lokasi', 'Sagulung')->first()->nama_lokasi ?? 'Sagulung';
        $lokasiSeiBeduk = LokasiKerja::where('nama_lokasi', 'Sei Beduk')->first()->nama_lokasi ?? 'Sei Beduk';


        $lowonganData = [
            // PT Batam Jaya Logistik (Logistik)
            ['perusahaan' => 'PT Batam Jaya Logistik', 'judul' => 'Staf Administrasi Logistik', 'kategori' => $kategoriLogistik, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamKota, 'deskripsi' => 'Mengelola dokumen pengiriman, koordinasi jadwal, dan pelaporan stok barang.', 'kualifikasi' => 'Min. D3 semua jurusan, pengalaman 1 tahun di bidang logistik/administrasi.', 'gaji' => 'Rp 3.500.000 - 4.500.000', 'status' => 'aktif', 'batas_akhir' => 30],
            ['perusahaan' => 'PT Batam Jaya Logistik', 'judul' => 'Driver Truk Fuso', 'kategori' => $kategoriLogistik, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiSagulung, 'deskripsi' => 'Mengirim barang antar gudang dan ke pelanggan sesuai jadwal. Memastikan kendaraan terawat.', 'kualifikasi' => 'Memiliki SIM B2 Umum, pengalaman min. 2 tahun. Siap bekerja keras.', 'gaji' => 'Rp 4.000.000 - 5.000.000', 'status' => 'aktif', 'batas_akhir' => 25],

            // PT Global Elektronik Nusantara (Manufaktur Elektronik)
            ['perusahaan' => 'PT Global Elektronik Nusantara', 'judul' => 'Teknisi Produksi', 'kategori' => $kategoriManufaktur, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamCenter, 'deskripsi' => 'Melakukan perakitan dan pengujian komponen elektronik. Memastikan kualitas produk.', 'kualifikasi' => 'Min. SMK Teknik Elektronika, fresh graduate welcome, teliti.', 'gaji' => 'Rp 3.000.000 - 4.000.000', 'status' => 'aktif', 'batas_akhir' => 35],
            ['perusahaan' => 'PT Global Elektronik Nusantara', 'judul' => 'Quality Control Staff', 'kategori' => $kategoriManufaktur, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamCenter, 'deskripsi' => 'Melakukan inspeksi kualitas produk sesuai standar. Membuat laporan QC.', 'kualifikasi' => 'Min. D3 Teknik Industri/Elektro, pengalaman 1 tahun di QC.', 'gaji' => 'Rp 3.800.000 - 5.000.000', 'status' => 'aktif', 'batas_akhir' => 40],
            ['perusahaan' => 'PT Global Elektronik Nusantara', 'judul' => 'R&D Engineer', 'kategori' => $kategoriIT, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamCenter, 'deskripsi' => 'Merancang dan mengembangkan produk elektronik baru. Melakukan riset pasar.', 'kualifikasi' => 'Min. S1 Teknik Elektro/Fisika, pengalaman 3 tahun di R&D.', 'gaji' => 'Rp 6.000.000 - 10.000.000', 'status' => 'aktif', 'batas_akhir' => 50],

            // CV Prima Konsultan (Konsultan Bisnis & IT)
            ['perusahaan' => 'CV Prima Konsultan', 'judul' => 'IT Support Specialist', 'kategori' => $kategoriIT, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamCenter, 'deskripsi' => 'Memberikan dukungan teknis kepada klien, instalasi software, dan troubleshooting jaringan.', 'kualifikasi' => 'Min. D3 Teknik Komputer, menguasai Windows/Linux, basic networking.', 'gaji' => 'Rp 3.500.000 - 5.500.000', 'status' => 'aktif', 'batas_akhir' => 30],
            ['perusahaan' => 'CV Prima Konsultan', 'judul' => 'Business Analyst Intern', 'kategori' => 'Keuangan', 'jenis' => $jenisMagang, 'lokasi' => $lokasiNagoya, 'deskripsi' => 'Membantu tim dalam menganalisis data bisnis dan menyusun laporan strategis.', 'kualifikasi' => 'Mahasiswa/i tingkat akhir jurusan Ekonomi/Manajemen, memiliki minat di analisis data.', 'gaji' => 'Rp 1.000.000 - 1.500.000', 'status' => 'aktif', 'batas_akhir' => 20],

            // PT Cahaya Baru Konstruksi (Konstruksi & Properti)
            ['perusahaan' => 'PT Cahaya Baru Konstruksi', 'judul' => 'Site Supervisor', 'kategori' => $kategoriKonstruksi, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiNongsa, 'deskripsi' => 'Mengawasi pekerjaan di lapangan, memastikan proyek sesuai jadwal dan kualitas.', 'kualifikasi' => 'Min. D3 Teknik Sipil, pengalaman 2 tahun sebagai supervisor proyek.', 'gaji' => 'Rp 5.000.000 - 8.000.000', 'status' => 'aktif', 'batas_akhir' => 45],
            ['perusahaan' => 'PT Cahaya Baru Konstruksi', 'judul' => 'Arsitek Landscape', 'kategori' => $kategoriKonstruksi, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamKota, 'deskripsi' => 'Merancang area hijau dan elemen landscape untuk proyek perumahan dan komersil.', 'kualifikasi' => 'Min. S1 Arsitektur Landscape, menguasai software desain (AutoCAD, SketchUp).', 'gaji' => 'Rp 4.500.000 - 7.000.000', 'status' => 'aktif', 'batas_akhir' => 30],

            // PT Samudera Bahari Logistik (Transportasi Laut & Perikanan)
            ['perusahaan' => 'PT Samudera Bahari Logistik', 'judul' => 'Staf Pelayaran', 'kategori' => 'Transportasi', 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatuAmpar, 'deskripsi' => 'Mengurus dokumen kapal, koordinasi dengan pihak pelabuhan, dan pemantauan jadwal.', 'kualifikasi' => 'Min. D3 Transportasi Laut, fresh graduate welcome.', 'gaji' => 'Rp 3.200.000 - 4.000.000', 'status' => 'aktif', 'batas_akhir' => 28],
            ['perusahaan' => 'PT Samudera Bahari Logistik', 'judul' => 'Analis Data Perikanan', 'kategori' => 'Logistik', 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamKota, 'deskripsi' => 'Menganalisis data tangkapan ikan dan rute pengiriman untuk efisiensi.', 'kualifikasi' => 'Min. S1 Perikanan/Statistika, menguasai Ms. Excel.', 'gaji' => 'Rp 4.000.000 - 6.000.000', 'status' => 'aktif', 'batas_akhir' => 35],

            // Hotel Indah Permai Batam (Hospitality)
            ['perusahaan' => 'Hotel Indah Permai Batam', 'judul' => 'Front Office Staff', 'kategori' => $kategoriHospitality, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiNagoya, 'deskripsi' => 'Melayani check-in/check-out tamu, menangani reservasi dan pertanyaan.', 'kualifikasi' => 'Min. SMA/SMK Pariwisata, ramah, kemampuan berbahasa Inggris aktif.', 'gaji' => 'Rp 3.000.000 - 4.000.000', 'status' => 'aktif', 'batas_akhir' => 20],
            ['perusahaan' => 'Hotel Indah Permai Batam', 'judul' => 'Cook Helper', 'kategori' => $kategoriHospitality, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiNagoya, 'deskripsi' => 'Membantu koki dalam menyiapkan bahan makanan dan menjaga kebersihan dapur.', 'kualifikasi' => 'Min. SMK Tata Boga, memiliki passion di dunia kuliner.', 'gaji' => 'Rp 2.500.000 - 3.000.000', 'status' => 'aktif', 'batas_akhir' => 15],

            // Batam Digital Kreatif (Media & Periklanan)
            ['perusahaan' => 'Batam Digital Kreatif', 'judul' => 'Social Media Specialist', 'kategori' => $kategoriPemasaran, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiSeiBeduk, 'deskripsi' => 'Mengelola akun media sosial klien, membuat konten, dan menganalisis performa.', 'kualifikasi' => 'Min. S1 Komunikasi/Pemasaran, pengalaman 1 tahun di medsos marketing.', 'gaji' => 'Rp 3.800.000 - 5.500.000', 'status' => 'aktif', 'batas_akhir' => 28],
            ['perusahaan' => 'Batam Digital Kreatif', 'judul' => 'Content Writer', 'kategori' => $kategoriPemasaran, 'jenis' => $jenisFreelance, 'lokasi' => 'Online', 'deskripsi' => 'Menulis artikel, blog, dan copy iklan untuk berbagai platform digital.', 'kualifikasi' => 'Memiliki kemampuan menulis yang baik, portofolio tulisan.', 'gaji' => 'Rp 100.000 - 300.000 / artikel', 'status' => 'aktif', 'batas_akhir' => 30],

            // PT Sentosa Manufaktur Global (Manufaktur Umum)
            ['perusahaan' => 'PT Sentosa Manufaktur Global', 'judul' => 'Operator Mesin CNC', 'kategori' => $kategoriManufaktur, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiSagulung, 'deskripsi' => 'Mengoperasikan dan memelihara mesin CNC. Memastikan produksi sesuai spesifikasi.', 'kualifikasi' => 'Min. SMK Teknik Mesin, pengalaman 1 tahun di mesin CNC.', 'gaji' => 'Rp 3.500.000 - 4.800.000', 'status' => 'aktif', 'batas_akhir' => 22],

            // RS Medika Batam (Kesehatan)
            ['perusahaan' => 'RS Medika Batam', 'judul' => 'Perawat IGD', 'kategori' => $kategoriKesehatan, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatuAmpar, 'deskripsi' => 'Memberikan asuhan keperawatan gawat darurat di unit IGD.', 'kualifikasi' => 'Min. D3 Keperawatan, memiliki STR aktif, pengalaman 1 tahun.', 'gaji' => 'Rp 4.000.000 - 6.000.000', 'status' => 'aktif', 'batas_akhir' => 28],
            ['perusahaan' => 'RS Medika Batam', 'judul' => 'Tenaga Rekam Medis', 'kategori' => $kategoriKesehatan, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatuAmpar, 'deskripsi' => 'Mengelola data rekam medis pasien, memastikan kelengkapan dan kerahasiaan.', 'kualifikasi' => 'Min. D3 Rekam Medis, teliti, menguasai sistem informasi rumah sakit.', 'gaji' => 'Rp 3.200.000 - 4.500.000', 'status' => 'aktif', 'batas_akhir' => 20],

            // Batam Retail Solutions (Perdagangan & Retail)
            ['perusahaan' => 'Batam Retail Solutions', 'judul' => 'Store Manager', 'kategori' => $kategoriRetail, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiBatamCenter, 'deskripsi' => 'Bertanggung jawab atas operasional toko harian, penjualan, dan kepuasan pelanggan.', 'kualifikasi' => 'Min. S1 semua jurusan, pengalaman 3 tahun sebagai Store Manager.', 'gaji' => 'Rp 5.000.000 - 8.000.000', 'status' => 'aktif', 'batas_akhir' => 35],
            ['perusahaan' => 'Batam Retail Solutions', 'judul' => 'Merchandiser Staff', 'kategori' => $kategoriRetail, 'jenis' => $jenisFulltime, 'lokasi' => $lokasiNagoya, 'deskripsi' => 'Merencanakan dan mengimplementasikan tampilan produk di toko. Memastikan ketersediaan stok.', 'kualifikasi' => 'Min. D3, memiliki kreativitas, pengalaman di retail 1 tahun.', 'gaji' => 'Rp 3.500.000 - 4.800.000', 'status' => 'aktif', 'batas_akhir' => 25],
        ];

        foreach ($lowonganData as $data) {
            $currentPerusahaan = $perusahaan[$data['perusahaan']];
            if ($currentPerusahaan) {
                Lowongan::firstOrCreate(
                    ['perusahaan_id' => $currentPerusahaan->id, 'judul_lowongan' => $data['judul']],
                    [
                        'kategori_pekerjaan' => $data['kategori'],
                        'jenis_pekerjaan' => $data['jenis'],
                        'lokasi_kerja' => $data['lokasi'],
                        'deskripsi_pekerjaan' => $data['deskripsi'],
                        'kualifikasi_pelamar' => $data['kualifikasi'],
                        'rentang_gaji' => $data['gaji'],
                        'batas_akhir_lamaran' => Carbon::today()->addDays($data['batas_akhir']),
                        'status_lowongan' => $data['status'],
                        'alasan_penolakan' => null,
                    ]
                );
                $this->command->info("Lowongan '{$data['judul']}' oleh '{$data['perusahaan']}' berhasil di-seed.");
            } else {
                $this->command->warn("Perusahaan '{$data['perusahaan']}' tidak ditemukan untuk lowongan '{$data['judul']}'.");
            }
        }
    }
}
