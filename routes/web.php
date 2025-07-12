<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers untuk Admin
use App\Http\Controllers\Admin\AdminController as AdminDashboardController;
use App\Http\Controllers\Admin\PerusahaanController as AdminPerusahaanController;
use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\Admin\DataMasterController as AdminDataMasterController;

// Import Controllers untuk Perusahaan
use App\Http\Controllers\Perusahaan\PerusahaanDashboardController;
use App\Http\Controllers\Perusahaan\LowonganPerusahaanController;
use App\Http\Controllers\Perusahaan\LamaranPerusahaanController;

// Import Controllers untuk Pelamar
use App\Http\Controllers\Pelamar\PelamarDashboardController;
use App\Http\Controllers\Pelamar\LowonganPelamarController as PelamarLowonganController; // Menggunakan alias LowonganPelamarController
use App\Http\Controllers\Pelamar\LamaranController;

// Import Controllers untuk Halaman Publik
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicLowonganController;
// HAPUS BARIS INI: use App\Http\Controllers\NotificationController; // Notifikasi sudah dihapus

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- Rute Umum (Landing Page) ---
// Menampilkan halaman beranda dengan lowongan terbaru dan link WhatsApp
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// --- Rute untuk Daftar dan Detail Lowongan yang Bisa Diakses Publik (Tanpa Login) ---
// Menggunakan prefix 'lowongan-publik' dan name 'lowongan.publik.' untuk konsistensi
Route::prefix('lowongan-publik')->name('lowongan.publik.')->group(function () {
    Route::get('/', [PublicLowonganController::class, 'index'])->name('index'); // Daftar lowongan publik
    Route::get('/{lowongan}', [PublicLowonganController::class, 'show'])->name('show'); // Detail lowongan publik
});


// --- Rute Dashboard Umum (Setelah Login) ---
// Middleware 'auth' saja, tanpa 'verified'. Logic redirect berdasarkan role ada di dalam sini.
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        } elseif (Auth::user()->role === 'pelamar') {
            return redirect()->route('pelamar.dashboard');
        }
    }
    // Fallback jika tidak ada role yang cocok atau belum login, arahkan ke homepage
    return redirect('/');
})->middleware(['auth'])->name('dashboard');


// --- Rute Admin ---
// Dilindungi oleh middleware 'auth' (sudah login) dan 'role:admin' (memiliki peran admin).
// TIDAK ADA middleware 'verified' di sini untuk admin.
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    // Manajemen Perusahaan oleh Admin (CRUD Resource)
    Route::resource('perusahaan', AdminPerusahaanController::class);
    // Rute POST khusus untuk toggle status perusahaan
    Route::post('perusahaan/{perusahaan}/toggle-status', [AdminPerusahaanController::class, 'toggleStatus'])->name('perusahaan.toggleStatus');

    // Manajemen Lowongan oleh Admin
    Route::get('lowongan', [AdminLowonganController::class, 'index'])->name('lowongan.index'); // Daftar lowongan
    Route::get('lowongan/{lowongan}', [AdminLowonganController::class, 'show'])->name('lowongan.show'); // Detail lowongan
    Route::post('lowongan/{lowongan}/approve', [AdminLowonganController::class, 'approve'])->name('lowongan.approve'); // Setujui lowongan
    Route::post('lowongan/{lowongan}/reject', [AdminLowonganController::class, 'reject'])->name('lowongan.reject'); // Tolak lowongan
    Route::delete('lowongan/{lowongan}', [AdminLowonganController::class, 'destroy'])->name('lowongan.destroy'); // Hapus lowongan

    // Rute Manajemen Data Master (CRUD)
    Route::prefix('data-master')->name('datamaster.')->group(function () {
        // Kategori Pekerjaan
        Route::get('kategori', [AdminDataMasterController::class, 'indexKategori'])->name('kategori.index');
        Route::post('kategori', [AdminDataMasterController::class, 'storeKategori'])->name('kategori.store');
        Route::put('kategori/{kategori}', [AdminDataMasterController::class, 'updateKategori'])->name('kategori.update');
        Route::delete('kategori/{kategori}', [AdminDataMasterController::class, 'destroyKategori'])->name('kategori.destroy');

        // Jenis Pekerjaan
        Route::get('jenis-pekerjaan', [AdminDataMasterController::class, 'indexJenisPekerjaan'])->name('jenisPekerjaan.index');
        Route::post('jenis-pekerjaan', [AdminDataMasterController::class, 'storeJenisPekerjaan'])->name('jenisPekerjaan.store');
        Route::put('jenis-pekerjaan/{jenisPekerjaan}', [AdminDataMasterController::class, 'updateJenisPekerjaan'])->name('jenisPekerjaan.update');
        Route::delete('jenis-pekerjaan/{jenisPekerjaan}', [AdminDataMasterController::class, 'destroyJenisPekerjaan'])->name('jenisPekerjaan.destroy');

        // Lokasi Kerja
        Route::get('lokasi', [AdminDataMasterController::class, 'indexLokasi'])->name('lokasi.index');
        Route::post('lokasi', [AdminDataMasterController::class, 'storeLokasi'])->name('lokasi.store');
        Route::put('lokasi/{lokasi}', [AdminDataMasterController::class, 'updateLokasi'])->name('lokasi.update');
        Route::delete('lokasi/{lokasi}', [AdminDataMasterController::class, 'destroyLokasi'])->name('lokasi.destroy');
    });
});


// --- Rute Perusahaan ---
// Dilindungi oleh middleware 'auth' (sudah login) dan 'role:perusahaan' (memiliki peran perusahaan).
// TIDAK ADA middleware 'verified' di sini untuk perusahaan.
Route::middleware(['auth', 'role:perusahaan'])->prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/dashboard', [PerusahaanDashboardController::class, 'dashboard'])->name('dashboard');

    // Profil Perusahaan (edit oleh Perusahaan itu sendiri)
    Route::get('/profil', [PerusahaanDashboardController::class, 'editProfile'])->name('profil.edit');
    Route::post('/profil', [PerusahaanDashboardController::class, 'updateProfile'])->name('profil.update');

    // Manajemen Lowongan oleh Perusahaan (CRUD Resource)
    Route::resource('lowongan', LowonganPerusahaanController::class);

    // Rute Manajemen Lamaran oleh Perusahaan
    Route::prefix('lamaran')->name('lamaran.')->group(function () {
        Route::get('/', [LamaranPerusahaanController::class, 'index'])->name('index');
        Route::get('/{lamaran}', [LamaranPerusahaanController::class, 'show'])->name('show');
        // Rute PUT untuk update status lamaran
        Route::put('/{lamaran}/update-status', [LamaranPerusahaanController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/{lamaran}/download-cv', [LamaranPerusahaanController::class, 'downloadCv'])->name('downloadCv');
    });
});


// --- Rute Pelamar ---
// Dilindungi oleh middleware 'auth' (sudah login) dan 'role:pelamar' (memiliki peran pelamar).
// Middleware 'verified' DIBIARKAN di sini JIKA PELAMAR MEMANG PERLU VERIFIKASI EMAIL.
// Jika tidak, hapus 'verified'.
Route::middleware(['auth', 'verified', 'role:pelamar'])->prefix('pelamar')->name('pelamar.')->group(function () {
    Route::get('/dashboard', [PelamarDashboardController::class, 'dashboard'])->name('dashboard');

    // Profil Pelamar (edit oleh Pelamar itu sendiri)
    Route::get('/profil', [PelamarDashboardController::class, 'editProfile'])->name('profil.edit');
    Route::post('/profil', [PelamarDashboardController::class, 'updateProfile'])->name('profil.update');

    // Lowongan untuk Pelamar (melihat dan mencari lowongan)
    // PASTIKAN MENGGUNAKAN ALIAS PelamarLowonganController DI SINI
    Route::get('/lowongan', [PelamarLowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/{lowongan}', [PelamarLowonganController::class, 'show'])->name('lowongan.show');

    // Proses Lamaran
    Route::post('/lamar', [LamaranController::class, 'store'])->name('lamar.store');
    Route::get('/lamaran', [LamaranController::class, 'index'])->name('lamaran.index'); // Riwayat lamaran
});


// --- Rute Autentikasi Laravel Breeze (Profil User default) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Rute Autentikasi default dari Laravel Breeze ---
require __DIR__.'/auth.php';
