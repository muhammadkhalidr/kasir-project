<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OrderanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\CetakLaporanController;
use App\Http\Controllers\CetakLaporanGajiController;
use App\Http\Controllers\CetakLaporanPembelianController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\LogTranasksiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\SettingController;
use App\Models\Orderan;
use App\Models\Pelanggan;

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

// Route::get('/', function () {
//     return view('pages.login', data: ['title' => 'Login']);
// });

// Route::get('login', [LoginController::class, 'index'])->name('login');

Route::get('/', [LayoutController::class, 'index'])->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

// Akses Untuk Admin
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['CekLevelUser:1']], function () {
        // Untuk Karyawan
        Route::resource('karyawan', KaryawanController::class);
        Route::get('/karyawan', [KaryawanController::class, 'index']);
        Route::get('/tambah-karyawan', [KaryawanController::class, 'tambahKaryawan']);
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');

        // Untuk Gaji Karyawan
        Route::resource('gajikaryawan', GajiKaryawanController::class);
        Route::get('/gaji-karyawan', [GajiKaryawanController::class, 'index']);
        Route::get('/tambah-gaji', [GajiKaryawanController::class, 'tambahGaji']);

        // Untuk Orderan
        Route::resource('orderan', OrderanController::class);
        Route::get('/orderan', [OrderanController::class, 'index'])->middleware('can:orderan.data');
        Route::get('/orderan-baru', [OrderanController::class, 'tambahOrderan']);
        Route::post('/orderan.pelunasan', [OrderanController::class, 'pelunasan'])->name('orderan.pelunasan');
        Route::post('/orderan/tambahPelanggan', [OrderanController::class, 'tambahPelanggan'])->name('orderan.tambahPelanggan');
        Route::post('/orderan.cari', [OrderanController::class, 'cariData'])->name('orderan.cari');

        // Untuk Dashboard
        Route::get('/home', [DashboardController::class, 'index']);

        // Untuk Pembelian
        Route::resource('/pembelian', PembelianController::class)->middleware('can:pembelian.data');
        Route::get('/pembelianbaru', [PembelianController::class, 'tambahPembelian']);
        // Route::get('/pembelian/{id_pembelian}', [PembelianController::class, 'index']);


        // Untuk Pengeluaran
        Route::resource('pengeluaran', PengeluaranController::class)->middleware('can:pengeluaran.data');
        Route::get('/pengeluaranbaru', [PengeluaranController::class, 'tambahPengeluaran']);

        // Untuk Data Keuangan
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');

        Route::resource('/hutang', HutangController::class);
        Route::post('/hutang/bayar', [HutangController::class, 'bayarHutang'])->name('hutang.bayar');

        // Untuk Laporan
        // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        // Route::post('/laporan/cetak', [LaporanController::class, 'index'])->name('laporan.cetakLaporan');

        // Untuk Profile
        Route::resource('profile', ProfileController::class);
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // Untuk Setting
        Route::resource('setting', SettingController::class);
        Route::post('/setting', [SettingController::class, 'editLogo']);

        // Untuk Pelanggan
        Route::resource('pelanggan', PelangganController::class);
        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::get('tambah-pelanggan', [PelangganController::class, 'tambahPelanggan']);


        // Untuk Rekening
        Route::resource('rekening', RekeningController::class);

        // Log Transaksi
        Route::get('/aktifitas', [LogTranasksiController::class, 'index']);

        // Piutang Penjualan
        Route::get('/piutang', [PiutangController::class, 'index']);

        // Rincian Pendapatan
        // Belum ada

        // Kas
        Route::get('/kas', [KasController::class, 'index']);
        Route::post('/kas', [KasController::class, 'tambahKas'])->name('kas.tambahKas');
        Route::delete('/kas/{no_reff}', [KasController::class, 'hapusKasKecil'])->name('kas.hapusKasKecil');
    });

    // Akses Untuk Owner
    Route::group(['middleware' => ['CekLevelUser:2']], function () {
        // Untuk Dashboard
        Route::get('/home', [DashboardController::class, 'index']);
        Route::resource('pengguna', PenggunaController::class)->middleware('can:pengguna.data');
        Route::get('/admin-baru', [PenggunaController::class, 'tambahPengguna']);
    });


    // Akses Untuk Kasir
    Route::group(['middleware' => ['CekLevelUser:3']], function () {

        // Untuk Orderan
        Route::resource('orderan', OrderanController::class);
        Route::get('/orderan', [OrderanController::class, 'index'])->middleware('can:orderan.data');
        Route::get('/orderan/{id}', [OrderanController::class, 'index']);
        Route::get('/orderan-baru', [OrderanController::class, 'tambahOrderan']);
        Route::post('/orderan.pelunasan', [OrderanController::class, 'pelunasan'])->name('orderan.pelunasan');
        Route::post('/orderan/tambahPelanggan', [OrderanController::class, 'tambahPelanggan'])->name('orderan.tambahPelanggan');
        Route::post('/orderan/filterJumlah', [OrderanController::class, 'filterJumlah'])->name('orderan.filterJumlah');


        // Untuk Dashboard
        Route::get('/home', [DashboardController::class, 'index']);

        // Untuk Pembelian
        Route::resource('/pembelian', PembelianController::class)->middleware('can:pembelian.data');
        Route::get('/pembelianbaru', [PembelianController::class, 'tambahPembelian']);

        // Untuk Pelanggan
        Route::resource('pelanggan', PelangganController::class);
        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::get('tambah-pelanggan', [PelangganController::class, 'tambahPelanggan']);

        // Untuk Pengeluaran
        Route::resource('pengeluaran', PengeluaranController::class)->middleware('can:pengeluaran.data');
        Route::get('/pengeluaranbaru', [PengeluaranController::class, 'tambahPengeluaran']);
    });
});

Route::get('orderan/print_invoice/{notrx}', [OrderanController::class, 'printInvoice'])->name('orderan.print_invoice');
Route::get('orderan/print_invoice58/{notrx}', [OrderanController::class, 'printInvoice58'])->name('orderan.print_invoice58');
Route::get('pengeluaran/print_laporan/{id_pengeluaran}', [PengeluaranController::class, 'printInvoice'])->name('cetak.print_invoice');
Route::get('pembelian/print_faktur/{id_pembelian}', [PembelianController::class, 'printFaktur'])->name('pembelian.print_faktur');
// Route::get('/laporan/cetak-laporan', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
// Route::post('/laporan/cetak-laporan', [LaporanController::class, 'cetakLaporan']);


// Untuk Laporan Keuangan
Route::get('laporan', [CetakLaporanController::class, 'index'])->name('laporan');
Route::get('laporan/records', [CetakLaporanController::class, 'records'])->name('laporan/records');

Route::get('laporan/pembelian', [CetakLaporanPembelianController::class, 'index'])->name('laporan/pembelian');
Route::get('laporan/pembelian/records', [CetakLaporanPembelianController::class, 'records_pembelian'])->name('laporan/pembelian/records');

Route::get('laporan/gaji', [CetakLaporanGajiController::class, 'index'])->name('laporan/gaji');
Route::get('laporan/gaji/records', [CetakLaporanGajiController::class, 'laporan_Gaji'])->name('laporan/gaji/records');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');



Route::get('/tescode', function () {
    return view('tescode');
});

Route::get('/cek', [OrderanController::class, 'cek']);

// 404
Route::get('{any}', function () {
    return view('errors.404');
});
