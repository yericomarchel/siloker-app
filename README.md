Siloker (Sistem Informasi Lowongan Kerja)
Contoh tampilan aplikasi Siloker (screenshot akan ditambahkan setelah deployment atau saat tersedia)

Aplikasi web Siloker adalah Sistem Informasi Lowongan Kerja berbasis web yang dirancang untuk memfasilitasi proses pencarian dan pengelolaan lowongan kerja, khususnya bagi Dinas Tenaga Kerja (Disnaker) Kota Batam. Aplikasi ini mempertemukan pencari kerja (Pelamar), perusahaan pemberi kerja (Perusahaan), dan administrator Disnaker dalam satu platform yang terintegrasi.

Dibangun dengan framework Laravel 10 (PHP) dan frontend Tailwind CSS, Siloker menawarkan antarmuka yang modern, responsif, dan mudah digunakan.

Fitur-Fitur Utama
Siloker menyediakan fitur-fitur komprehensif untuk setiap peran pengguna:

1. Peran Pelamar (Pencari Kerja)
Pendaftaran & Profil: Mendaftar akun baru, melengkapi profil dengan NIK, riwayat pendidikan, pengalaman, keahlian, serta mengunggah CV dan foto profil.

Pencarian Lowongan: Mencari lowongan kerja aktif dengan berbagai filter (lokasi, jenis pekerjaan, kategori, pendidikan, pengalaman, gaji).

Detail Lowongan: Melihat informasi detail lowongan kerja.

Pengajuan Lamaran: Melamar pekerjaan langsung melalui sistem dengan data profil yang sudah diunggah. (Tidak dapat melamar lowongan yang sama dua kali).

Riwayat Lamaran: Memantau status lamaran yang diajukan (Menunggu, Dilihat, Dalam Proses, Diterima, Ditolak).

2. Peran Perusahaan (Pemberi Kerja)
Manajemen Akun: Akun perusahaan dibuat dan dikelola oleh Admin Disnaker.

Profil Perusahaan: Mengelola detail profil perusahaan dan mengunggah logo.

Manajemen Lowongan: Membuat, mengedit, dan menghapus lowongan pekerjaan yang mereka posting. Lowongan memerlukan persetujuan Admin untuk aktif.

Manajemen Lamaran: Melihat daftar pelamar untuk setiap lowongan mereka, melihat detail profil pelamar, mengunduh CV, dan memperbarui status lamaran.

3. Peran Admin Disnaker
Dashboard Informatif: Melihat ringkasan statistik aplikasi (total pelamar, perusahaan, lowongan aktif, lowongan menunggu persetujuan).

Manajemen Perusahaan: Membuat, mengedit, menghapus, serta mengaktifkan/menonaktifkan akun perusahaan.

Manajemen Lowongan: Melihat semua lowongan, menyetujui, menolak (dengan alasan), atau menghapus lowongan.

Manajemen Data Master: Mengelola data master seperti Kategori Pekerjaan, Jenis Pekerjaan, dan Lokasi Kerja secara dinamis melalui CRUD (Create, Read, Update, Delete) di panel admin.

4. Fitur Umum & Publik
Halaman Depan (Landing Page): Menampilkan informasi singkat aplikasi, daftar lowongan terbaru, dan tautan langsung ke Helpdesk Disnaker via WhatsApp.

Pencarian Lowongan Publik: Halaman khusus untuk publik (tanpa login) untuk mencari dan melihat detail lowongan kerja aktif.

Antarmuka Responsif: Tampilan yang optimal di berbagai perangkat (desktop, tablet, mobile) menggunakan Tailwind CSS.

Teknologi yang Digunakan
Backend: PHP 8.1+ dengan Framework Laravel 10

Database: MySQL

Frontend: HTML, CSS (Tailwind CSS), JavaScript (Vanilla JS)

Autentikasi: Laravel Breeze

Tools: Composer, npm, Vite

Persyaratan Sistem
Pastikan sistem Anda memenuhi persyaratan berikut sebelum memulai instalasi:

PHP >= 8.1

MySQL Database

Composer (Manajer paket PHP)

Node.js & npm (Untuk mengelola aset frontend)

Web Server (Apache / Nginx, atau lingkungan lokal seperti XAMPP/Laragon/Valet)

Cara Menjalankan Proyek (Lokal)
Ikuti langkah-langkah di bawah ini untuk menjalankan proyek Siloker di lingkungan pengembangan lokal Anda.

1. Clone Repositori
Buka Terminal atau Command Prompt Anda, lalu navigasikan ke direktori tempat Anda ingin menyimpan proyek, kemudian jalankan perintah berikut:

git clone https://github.com/nama-pengguna-github-anda/nama-repositori-siloker.git
cd nama-repositori-siloker

Catatan: Ganti https://github.com/nama-pengguna-github-anda/nama-repositori-siloker.git dengan URL repositori GitHub Anda yang sebenarnya.

2. Instal Dependensi PHP
Jalankan perintah ini untuk menginstal semua pustaka PHP yang dibutuhkan proyek (yang didefinisikan dalam composer.json):

composer install

3. Konfigurasi Environment File
Buat salinan file .env.example dan ubah namanya menjadi .env. File .env.example menyediakan template konfigurasi yang diperlukan.

cp .env.example .env  # Untuk Linux/macOS
copy .env.example .env # Untuk Windows

Kemudian, buka file .env yang baru Anda buat dengan text editor (seperti VS Code, Sublime Text, Notepad++) dan konfigurasi pengaturan database serta Mailtrap Anda. Ini adalah langkah krusial agar aplikasi dapat terhubung ke database dan mengirim email.

APP_NAME="Siloker"
APP_ENV=local
APP_KEY= # Akan di-generate otomatis pada langkah berikutnya
APP_DEBUG=true
APP_URL=http://localhost:8000 # URL aplikasi Anda saat dijalankan secara lokal

# Konfigurasi Database MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disnaker_batam_db # **Penting:** Pastikan nama database ini sudah Anda buat di phpMyAdmin atau tool database Anda
DB_USERNAME=root # Ganti dengan username MySQL Anda (default XAMPP adalah 'root')
DB_PASSWORD= # Ganti dengan password MySQL Anda (default XAMPP biasanya kosong)

# Konfigurasi Mailtrap (Untuk pengujian pengiriman email lokal)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=YOUR_MAILTRAP_USERNAME # Ganti dengan username Mailtrap Anda
MAIL_PASSWORD=YOUR_MAILTRAP_PASSWORD # Ganti dengan password Mailtrap Anda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="${MAIL_USERNAME}@mailtrap.io" # Disarankan menggunakan ini untuk kompatibilitas Mailtrap
MAIL_FROM_NAME="${APP_NAME}"

# Konfigurasi Vite (Untuk kompilasi aset frontend seperti Tailwind CSS)
VITE_APP_NAME="${APP_NAME}"
# VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"     # Hapus atau komentari jika Anda tidak menggunakan Pusher
# VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}" # Hapus atau komentari jika Anda tidak menggunakan Pusher

Catatan: Pastikan untuk mengganti nilai YOUR_MAILTRAP_USERNAME dan YOUR_MAILTRAP_PASSWORD dengan kredensial dari akun Mailtrap Anda agar fitur email dapat berfungsi saat development.

4. Generate Application Key
Perintah ini akan menghasilkan kunci unik untuk aplikasi Anda, yang diperlukan untuk enkripsi dan keamanan sesi:

php artisan key:generate

5. Buat dan Migrasi Database
Pastikan server MySQL Anda sudah berjalan. Anda harus membuat database kosong dengan nama yang sama seperti yang Anda atur di DB_DATABASE pada file .env (misal: disnaker_batam_db). Anda bisa membuatnya melalui phpMyAdmin, MySQL Workbench, atau tool database lainnya.

Setelah database dibuat, jalankan migrasi database untuk membuat semua tabel yang diperlukan, dan seeders untuk mengisi data awal (akun demo, data master, dll.):

php artisan migrate:fresh --seed

Perhatian: Perintah migrate:fresh --seed akan menghapus semua tabel yang ada di database Anda (jika ada) sebelum membuatnya kembali dan mengisinya dengan data dari seeders. Gunakan dengan hati-hati pada database yang sudah berisi data penting.

6. Buat Symbolic Link untuk Storage
Ini diperlukan agar file yang diunggah oleh pengguna (misal: logo perusahaan, CV pelamar) bisa disimpan dan diakses melalui web server:

php artisan storage:link

7. Instal Dependensi JavaScript
Instal semua pustaka JavaScript yang dibutuhkan proyek (terutama untuk Tailwind CSS dan dependensi frontend lainnya) yang didefinisikan dalam package.json:

npm install

8. Kompilasi Aset Frontend
Jalankan perintah ini untuk mengkompilasi CSS (Tailwind CSS) dan JavaScript dari source code menjadi file yang siap digunakan oleh browser:

npm run dev

Jika Anda ingin aset dikompilasi dan terus memantau perubahan file (untuk pengembangan), gunakan npm run watch. Untuk produksi, gunakan npm run build.

9. Jalankan Aplikasi
Terakhir, mulai server pengembangan Laravel Anda. Ini akan membuat aplikasi dapat diakses di browser:

php artisan serve

Aplikasi akan dapat diakses di browser Anda melalui URL: http://127.0.0.1:8000.

Akun Demo (Default)
Anda dapat login menggunakan akun-akun berikut untuk menguji berbagai peran setelah menjalankan php artisan migrate:fresh --seed:

Admin Disnaker:

Email: admin@disnakerbatam.go.id

Password: password123

Perusahaan (PT Batam Jaya Logistik):

Email: ptbatamjaya@example.com

Password: password

Pelamar (Andi Wijaya):

Email: andi@example.com

Password: password

Kontribusi
Jika Anda ingin berkontribusi pada proyek ini, silakan fork repositori, buat branch baru untuk fitur/perbaikan Anda, dan ajukan Pull Request Anda. Kami menyambut kontribusi yang membangun!

Lisensi
[Tentukan lisensi proyek Anda di sini, contoh: MIT License]
Disarankan menggunakan lisensi seperti MIT License untuk proyek open-source.

User Flow Aplikasi
Berikut adalah alur interaksi pengguna yang rinci untuk setiap peran dalam aplikasi Siloker.

1. Alur Umum & Halaman Depan (Landing Page)
Pengunjung (Belum Login) / Pelamar / Perusahaan:

Mengakses website Siloker.

Melihat Halaman Depan (Landing Page): Menampilkan deskripsi singkat, lowongan aktif terbaru, tombol "Cari Lowongan", dan tautan Helpdesk WhatsApp.

Dapat melihat detail lowongan publik atau menggunakan filter pencarian.

Memilih untuk "Login" atau "Daftar" (untuk Pelamar baru).

2. Alur Peran Pelamar (Pencari Kerja)
Pendaftaran & Login:

Daftar: Membuat akun baru dengan email dan password.

Login: Masuk ke akun yang sudah ada.

Setelah login, diarahkan ke Dashboard Pelamar.

Pengelolaan Profil:

Jika profil belum lengkap, pelamar akan diminta untuk melengkapi data pribadi (NIK, tanggal lahir, alamat, telepon), riwayat (pendidikan, pengalaman kerja, keahlian), serta mengunggah CV dan foto profil.

Penting: Melamar pekerjaan hanya bisa dilakukan jika profil sudah lengkap.

Mencari & Melihat Lowongan:

Melihat daftar lowongan aktif.

Menggunakan pencarian kata kunci dan filter (lokasi, jenis, kategori, pendidikan, pengalaman, gaji) untuk menemukan lowongan yang sesuai.

Melihat detail lengkap lowongan.

Melamar Pekerjaan:

Dari halaman detail lowongan, jika lowongan aktif dan profil lengkap, tombol "Lamar Pekerjaan Ini" akan aktif.

Mengirimkan lamaran menggunakan data profil dan CV yang sudah diunggah.

Penting: Tidak dapat melamar lowongan yang sama dua kali.

Riwayat Lamaran:

Melihat daftar semua lamaran yang diajukan dengan status (Menunggu, Dilihat, Dalam Proses, Diterima, Ditolak).

3. Alur Peran Perusahaan (Pemberi Kerja)
Pembuatan & Login Akun:

Penting: Akun perusahaan dibuat oleh Admin Disnaker.

Perusahaan login menggunakan kredensial yang diberikan Admin.

Setelah login, diarahkan ke Dashboard Perusahaan.

Pengelolaan Profil Perusahaan:

Mengedit detail profil perusahaan (alamat, kontak, deskripsi) dan mengunggah logo.

Manajemen Lowongan:

Membuat Lowongan Baru: Mengisi detail lowongan (judul, deskripsi, kualifikasi, gaji, batas akhir), memilih data master (kategori, jenis, lokasi).

Lowongan yang baru dibuat berstatus "Menunggu Persetujuan".

Melihat daftar semua lowongan yang diposting dengan statusnya.

Mengedit atau menghapus lowongan.

Manajemen Lamaran Masuk:

Melihat daftar semua lamaran yang masuk untuk lowongan mereka.

Menggunakan filter (status, lowongan, nama pelamar) untuk mempermudah pencarian.

Melihat detail lengkap pelamar (profil, kontak) dan mengunduh CV.

Mengubah status lamaran (Menunggu Proses, Diterima, Ditolak, Wawancara).

4. Alur Peran Admin Disnaker
Login:

Login menggunakan kredensial Admin.

Diarahkan ke Dashboard Admin.

Dashboard Admin:

Melihat ringkasan statistik aplikasi (jumlah pelamar, perusahaan, lowongan aktif, lowongan menunggu persetujuan).

Manajemen Perusahaan:

Membuat akun baru untuk perusahaan.

Melihat, mengedit, menghapus, serta mengaktifkan/menonaktifkan akun perusahaan.

Manajemen Lowongan:

Melihat semua lowongan yang ada di sistem.

Verifikasi Lowongan: Menyetujui atau menolak lowongan yang diajukan perusahaan (dengan alasan penolakan).

Dapat mengedit atau menghapus lowongan.

Manajemen Data Master:

Mengelola (menambah, mengedit, menghapus) Kategori Pekerjaan, Jenis Pekerjaan, dan Lokasi Kerja.

Use Case Aplikasi
Berikut adalah daftar use case utama yang menggambarkan interaksi pengguna dengan sistem.

1. Use Case Pelamar
UC-P01: Mendaftar Akun Pelamar

Aktor: Pelamar

Tujuan: Membuat akun baru untuk mengakses fitur aplikasi.

Alur Utama: Akses halaman daftar -> Isi data registrasi (nama, email, password) -> Submit -> Verifikasi email (jika diaktifkan) -> Login otomatis.

UC-P02: Mengelola Profil Pelamar

Aktor: Pelamar

Tujuan: Melengkapi dan memperbarui informasi pribadi, riwayat pendidikan, pengalaman, keahlian, serta mengunggah CV dan foto profil.

Alur Utama: Login -> Akses halaman profil -> Isi/perbarui data -> Unggah file -> Simpan.

UC-P03: Mencari Lowongan Kerja

Aktor: Pelamar / Pengunjung

Tujuan: Menemukan lowongan kerja yang sesuai dengan kriteria.

Alur Utama: Akses halaman pencarian lowongan -> Masukkan kata kunci dan/atau gunakan filter -> Lihat hasil pencarian.

UC-P04: Melamar Lowongan Kerja

Aktor: Pelamar

Tujuan: Mengajukan lamaran untuk lowongan yang diminati.

Alur Utama: Login -> Lihat detail lowongan -> Klik "Lamar Pekerjaan Ini" (jika profil lengkap dan belum pernah melamar) -> Konfirmasi lamaran -> Lamaran terkirim.

UC-P05: Melihat Riwayat Lamaran

Aktor: Pelamar

Tujuan: Memantau status lamaran yang telah diajukan.

Alur Utama: Login -> Akses halaman riwayat lamaran -> Lihat daftar lamaran dan statusnya.

2. Use Case Perusahaan
UC-PR01: Mengelola Profil Perusahaan

Aktor: Perusahaan

Tujuan: Memperbarui informasi detail perusahaan dan logo.

Alur Utama: Login -> Akses halaman profil perusahaan -> Isi/perbarui data -> Unggah logo -> Simpan.

UC-PR02: Membuat Lowongan Kerja Baru

Aktor: Perusahaan

Tujuan: Memposting lowongan pekerjaan untuk mencari kandidat.

Alur Utama: Login -> Akses halaman manajemen lowongan -> Klik "Buat Lowongan Baru" -> Isi detail lowongan -> Pilih data master (kategori, jenis, lokasi) -> Simpan -> Lowongan berstatus "Menunggu Persetujuan Admin".

UC-PR03: Mengelola Lowongan Kerja

Aktor: Perusahaan

Tujuan: Mengedit atau menghapus lowongan pekerjaan yang sudah diposting.

Alur Utama: Login -> Akses halaman manajemen lowongan -> Pilih lowongan -> Edit detail atau hapus lowongan.

UC-PR04: Mengelola Lamaran Masuk

Aktor: Perusahaan

Tujuan: Melihat dan memproses lamaran yang masuk untuk lowongan mereka.

Alur Utama: Login -> Akses halaman manajemen lamaran -> Filter/cari lamaran -> Lihat detail pelamar (profil, CV) -> Ubah status lamaran (Menunggu Proses, Diterima, Ditolak, Wawancara).

3. Use Case Admin Disnaker
UC-A01: Mengelola Akun Perusahaan

Aktor: Admin Disnaker

Tujuan: Membuat, mengedit, menghapus, dan mengaktifkan/menonaktifkan akun perusahaan.

Alur Utama: Login -> Akses manajemen perusahaan -> Tambah/edit/hapus/ubah status akun perusahaan.

UC-A02: Memverifikasi Lowongan Kerja

Aktor: Admin Disnaker

Tujuan: Menyetujui atau menolak lowongan kerja yang diajukan perusahaan.

Alur Utama: Login -> Akses manajemen lowongan -> Lihat lowongan "Menunggu Persetujuan" -> Lihat detail lowongan -> Setujui atau Tolak (dengan alasan).

UC-A03: Mengelola Data Master

Aktor: Admin Disnaker

Tujuan: Menambah, mengedit, dan menghapus data master (kategori, jenis pekerjaan, lokasi kerja).

Alur Utama: Login -> Akses manajemen data master -> Pilih jenis data master -> Tambah/edit/hapus entri.

UC-A04: Memantau Dashboard Aplikasi

Aktor: Admin Disnaker

Tujuan: Melihat ringkasan statistik dan aktivitas terkini aplikasi.

Alur Utama: Login -> Akses dashboard admin -> Lihat kartu statistik dan ringkasan.

ERD (Entity-Relationship Diagram)
Berikut adalah representasi Entity-Relationship Diagram (ERD) untuk struktur database aplikasi Siloker.

erDiagram
    USERS {
        BIGINT id PK
        VARCHAR name
        VARCHAR email UK
        TIMESTAMP email_verified_at
        VARCHAR password
        VARCHAR role
        BOOLEAN is_active
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    PERUSAHAAN {
        BIGINT id PK
        BIGINT user_id FK "USERS"
        VARCHAR nama_perusahaan
        VARCHAR jenis_usaha
        TEXT alamat_kantor
        VARCHAR nomor_telepon_perusahaan
        VARCHAR email_perusahaan UK
        VARCHAR npwp_nib UK
        VARCHAR nama_penanggung_jawab
        VARCHAR jabatan_penanggung_jawab
        VARCHAR logo_perusahaan
        TEXT deskripsi_singkat
        BOOLEAN is_aktif
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    PELAMAR {
        BIGINT id PK
        BIGINT user_id FK "USERS"
        VARCHAR nik UK
        DATE tanggal_lahir
        TEXT alamat_domisili
        VARCHAR nomor_telepon
        TEXT pendidikan
        TEXT pengalaman_kerja
        TEXT keahlian
        VARCHAR path_cv
        VARCHAR path_foto_profil
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    LOWONGAN {
        BIGINT id PK
        BIGINT perusahaan_id FK "PERUSAHAAN"
        VARCHAR judul_lowongan
        VARCHAR kategori_pekerjaan
        ENUM jenis_pekerjaan
        VARCHAR lokasi_kerja
        TEXT deskripsi_pekerjaan
        TEXT kualifikasi_pelamar
        VARCHAR rentang_gaji
        DATE batas_akhir_lamaran
        ENUM status_lowongan
        TEXT alasan_penolakan
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    LAMARAN {
        BIGINT id PK
        BIGINT pelamar_id FK "PELAMAR"
        BIGINT lowongan_id FK "LOWONGAN"
        ENUM status_lamaran
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    KATEGORI_PEKERJAAN {
        BIGINT id PK
        VARCHAR nama_kategori UK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    JENIS_PEKERJAAN {
        BIGINT id PK
        VARCHAR nama_jenis UK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    LOKASI_KERJA {
        BIGINT id PK
        VARCHAR nama_lokasi UK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    USERS ||--o{ PERUSAHAAN : "memiliki"
    USERS ||--o{ PELAMAR : "memiliki"
    PERUSAHAAN ||--o{ LOWONGAN : "memposting"
    PELAMAR ||--o{ LAMARAN : "mengajukan"
    LOWONGAN ||--o{ LAMARAN : "menerima"

Penjelasan ERD:

USERS: Tabel inti untuk semua akun pengguna (Admin, Perusahaan, Pelamar). Kolom role membedakan jenis pengguna.

PERUSAHAAN: Menyimpan detail profil perusahaan. Setiap perusahaan terhubung ke satu user di tabel USERS.

PELAMAR: Menyimpan detail profil pelamar. Setiap pelamar terhubung ke satu user di tabel USERS.

LOWONGAN: Menyimpan detail lowongan pekerjaan. Setiap lowongan diposting oleh satu PERUSAHAAN.

LAMARAN: Menyimpan data pengajuan lamaran. Ini adalah tabel pivot yang menghubungkan PELAMAR dengan LOWONGAN yang mereka lamar.

KATEGORI_PEKERJAAN, JENIS_PEKERJAAN, LOKASI_KERJA: Tabel-tabel data master yang dikelola oleh Admin untuk menyediakan pilihan di formulir lowongan dan filter pencarian.
