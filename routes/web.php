<?php

use App\Http\Controllers\AuditoriumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\KursiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenayanganController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PTDLController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Route;

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

// Autentikasi
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth_login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'auth_logout'])->middleware('auth');
Route::get('/akses_eror', function(){return view("akses_eror");})->middleware('auth');

// Dashboard
Route::get('/', [BerandaController::class, 'index'])->middleware(['auth', 'admin_petugas']);

// Film
Route::get('/film', [FilmController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/tambah-film', [FilmController::class, 'tambah_film'])->middleware(['auth', 'admin']);
Route::post('/simpan-filem', [FilmController::class, 'simpan_film'])->middleware(['auth', 'admin']);
Route::get('/lihat-filem/{id}', [FilmController::class, 'lihat_film'])->middleware(['auth', 'admin']);
Route::put('/update-film/{id}', [FilmController::class, 'update_film'])->middleware(['auth', 'admin']);
Route::get('/hapus-film/{id}', [FilmController::class, 'hapus_film'])->middleware(['auth', 'admin']);
Route::get('/cari-film', [FilmController::class, 'cari_film'])->middleware(['auth', 'admin']);

// Auditorium
Route::get('/auditorium', [AuditoriumController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/tambah-auditorium', [AuditoriumController::class, 'tambah_auditorium'])->middleware(['auth', 'admin']);
Route::post('/simpan-auditorium', [AuditoriumController::class, 'simpan_auditorium'])->middleware(['auth', 'admin']);
Route::get('/lihat-auditorium/{id}', [AuditoriumController::class, 'lihat_auditorium'])->middleware(['auth', 'admin']);
Route::put('/ubah-auditorium/{id}', [AuditoriumController::class, 'ubah_auditorium'])->middleware(['auth', 'admin']);
Route::get('/hapus-auditorium/{id}', [AuditoriumController::class, 'hapus_auditorium'])->middleware(['auth', 'admin']);
Route::get('/cari-auditorium', [AuditoriumController::class, 'cari_auditorium'])->middleware(['auth', 'admin']);

// Kursi
Route::get('/kursi', [KursiController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/tambah-kursi', [KursiController::class, 'tambah_kursi'])->middleware(['auth', 'admin']);
Route::post('/simpan-kursi', [KursiController::class, 'simpan_kursi'])->middleware(['auth', 'admin']);
Route::get('/lihat-kursi/{kode_kursi}', [KursiController::class, 'lihat_kursi'])->middleware(['auth', 'admin']);
Route::put('/update-kursi/{kode_kursi}', [KursiController::class, 'update_kursi'])->middleware(['auth', 'admin']);
Route::get('/hapus-kursi/{kode_kursi}', [KursiController::class, 'hapus_kursi'])->middleware(['auth', 'admin']);
Route::get('/cari-kursi', [KursiController::class, 'cari_kursi'])->middleware(['auth', 'admin']);

// Penayangan
Route::get('/penayangan', [PenayanganController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/tambah-penayangan', [PenayanganController::class, 'tambah_penayangan'])->middleware(['auth', 'admin']);
Route::post('/simpan-penayangan', [PenayanganController::class, 'simpan_penayangan'])->middleware(['auth', 'admin']);
Route::get('/lihat-penayangan/{kode_penayangan}', [PenayanganController::class, 'lihat_penayangan'])->middleware(['auth', 'admin']);
Route::put('/ubah-penayangan/{kode_penayangan}', [PenayanganController::class, 'ubah_penayangan'])->middleware(['auth', 'admin']);
Route::get('/hapus-penayangan/{kode_penayangan}', [PenayanganController::class, 'hapus_penayangan'])->middleware(['auth', 'admin']);

// Petugas
Route::get('/petugas', [PetugasController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/tambah-petugas', [PetugasController::class, 'tambah_petugas'])->middleware(['auth', 'admin']);
Route::post('/simpan-petugas', [PetugasController::class, 'simpan_petugas'])->middleware(['auth', 'admin']);
Route::post('/hapus-petugas', [PetugasController::class, 'hapus_petugas'])->middleware(['auth', 'admin']);
Route::get('/cari-petugas', [PetugasController::class, 'cari_petugas'])->middleware(['auth', 'admin']);

// Tiket
Route::get('/tiket', [TiketController::class, 'index'])->middleware(['auth', 'admin_petugas']);
Route::get('/lihat-tiket/{kode_tiket}', [TiketController::class, 'lihat_tiket'])->middleware(['auth', 'admin_petugas']);
Route::get('/cek-in/{kode_tiket}', [TiketController::class, 'cek_in'])->middleware(['auth', 'admin_petugas']);
Route::get('/cetak-tiket/{kode_tiket}', [TiketController::class, 'cetak_tiket'])->middleware(['auth', 'admin_petugas']);

// PTDL
Route::get('/ptdl', [PTDLController::class, 'index'])->middleware(['auth', 'admin_petugas']);
Route::get('/beli-tiket', [PTDLController::class, 'beli_tiket'])->middleware(['auth', 'admin_petugas']);
Route::get('/ambil-penayangan', [PTDLController::class, 'ambil_penayangan'])->middleware(['auth', 'admin_petugas']);
Route::post('/simpan-pembelian', [PTDLController::class, 'simpan_pembelian'])->middleware(['auth', 'admin_petugas']);
Route::get('/pembayaran-sukses/{kode_registrasi}', [PTDLController::class, 'pembayaran_sukses'])->middleware(['auth', 'admin_petugas']);
Route::post('/hapus-registrasi', [PTDLController::class, 'hapus_registrasi'])->middleware(['auth', 'admin_petugas']);

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->middleware(['auth', 'admin_petugas']);

// Laporan
Route::get('/laporan', [LaporanController::class, 'index'])->middleware(['auth', 'admin_petugas']);
