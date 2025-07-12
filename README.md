# Siloker (Sistem Informasi Lowongan Kerja)

> Aplikasi web Siloker adalah Sistem Informasi Lowongan Kerja berbasis Laravel untuk memfasilitasi pencari kerja, perusahaan, dan Disnaker Kota Batam.

![Siloker Screenshot](#) <!-- Ganti # dengan path gambar jika sudah tersedia -->

## 📌 Deskripsi

Siloker adalah aplikasi web yang menghubungkan pencari kerja (Pelamar), perusahaan pemberi kerja (Perusahaan), dan administrator Disnaker dalam satu platform terintegrasi.

- **Backend:** Laravel 10 (PHP)
- **Frontend:** Tailwind CSS
- **Database:** MySQL

---

## ✨ Fitur Utama

### 👤 Pelamar (Pencari Kerja)

- Pendaftaran & Profil: Mendaftar akun baru, melengkapi profil (NIK, riwayat pendidikan, pengalaman, keahlian, CV & foto).
- Pencarian Lowongan: Filter berdasarkan lokasi, jenis, kategori, pendidikan, pengalaman, gaji.
- Detail Lowongan: Melihat info detail.
- Pengajuan Lamaran: Melamar langsung melalui sistem.
- Riwayat Lamaran: Memantau status lamaran.

### 🏢 Perusahaan (Pemberi Kerja)

- Manajemen Akun: Dibuat oleh Admin Disnaker.
- Profil Perusahaan: Kelola data & logo.
- Manajemen Lowongan: CRUD lowongan (butuh approval admin).
- Manajemen Lamaran: Lihat pelamar, unduh CV, update status.

### 🛡️ Admin Disnaker

- Dashboard Informatif: Statistik pelamar, perusahaan, dan lowongan.
- Manajemen Perusahaan: CRUD + aktivasi akun.
- Manajemen Lowongan: Verifikasi/tolak lowongan.
- Data Master: CRUD Kategori, Jenis, Lokasi.

### 🌐 Fitur Umum

- Landing Page: Informasi aplikasi, daftar lowongan terbaru, link Helpdesk WhatsApp.
- Pencarian Tanpa Login.
- Responsif: Desktop, tablet, mobile.

---

## ⚙️ Teknologi yang Digunakan

| Komponen     | Teknologi            |
|--------------|----------------------|
| Backend      | PHP 8.1+, Laravel 10 |
| Frontend     | Tailwind CSS, HTML, JS |
| Database     | MySQL                |
| Autentikasi  | Laravel Breeze       |
| Tools        | Composer, npm, Vite  |

---

## 💻 Persyaratan Sistem

- PHP >= 8.1
- MySQL Database
- Composer
- Node.js & npm
- Web Server (Apache/Nginx/XAMPP)

---

## 🚀 Cara Menjalankan Proyek (Lokal)

```bash
# 1. Clone repositori
git clone https://github.com/nama-pengguna/nama-repo.git
cd nama-repo

# 2. Install dependensi PHP
composer install

# 3. Setup environment
cp .env.example .env  # Linux/macOS
# atau
copy .env.example .env # Windows

# 4. Edit .env dan sesuaikan database, mailtrap, dll.

# 5. Generate APP Key
php artisan key:generate

# 6. Migrasi & seeding database
php artisan migrate:fresh --seed

# 7. Storage link
php artisan storage:link

# 8. Install frontend
npm install

# 9. Kompilasi asset
npm run dev

# 10. Jalankan aplikasi
php artisan serve
