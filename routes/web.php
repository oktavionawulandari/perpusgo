<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TransaksiController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route untuk menampilkan halaman awal
Route::get('/', function () {
    return view('awal');
});
Route::get('/navigasi', function () {
    return view('navigasi');
});


//---------Login dan Logout--------------//
//Route untuk menampilkan halaman form login
Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Route untuk mengirimkan data login
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('post.login');


//----Route group untuk halaman yang bisa diakses oleh Role Admin dan Pustakawan----//
Route::group(['middleware' => ['auth:user', 'cekrole:Admin,Pustakawan']], function () {
    Route::get('/home/pegawai', [HomeController::class, 'homepegawai'])->name('home.pegawai');
    //Route untuk edit Profile dan Ubah Password
    Route::get('/editprofile-pegawai', [PegawaiController::class, 'editProfile'])->name('pegawai.editprofile');
    Route::put('/updateprofile-pegawai/{id}', [PegawaiController::class, 'updateProfile'])->name('pegawai.updateprofile');
    Route::get('/ubahpassword', [PegawaiController::class, 'ubahPassword'])->name('pegawai.ubahpassword');
    Route::put('/updatepassword', [PegawaiController::class, 'updatePassword'])->name('pegawai.updatepassword');

    //Fitur Anggota
    Route::resource('/anggota', AnggotaController::class);
    Route::get('/anggota/hapus/{id}', [AnggotaController::class, 'hapus'])->name('anggota.hapus');
    Route::get('/dataanggota/exportpdf', [AnggotaController::class, 'cetak_pdf'])->name('anggota.pdf');
    Route::get('/dataanggota/exportexcel', [AnggotaController::class, 'cetak_excel'])->name('anggota.excel');

    //Fitur Buku
    Route::resource('/buku', BukuController::class);
    Route::get('/buku/hapus/{id}', [BukuController::class, 'hapus'])->name('buku.hapus');
    Route::get('/databuku/exportpdf', [BukuController::class, 'cetak_pdf'])->name('buku.pdf');
    Route::get('/databuku/exportexcel', [BukuController::class, 'cetak_excel'])->name('buku.excel');

    //Fitur Transaksi
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/transaksi/perpanjang/{id}', [TransaksiController::class, 'perpanjang'])->name('transaksi.perpanjang');
    Route::get('/transaksi/kembali/{id}/{denda}/{id_buku}', [TransaksiController::class, 'kembali'])->name('transaksi.kembali');
    Route::get('/datatransaksi/exportpdf', [TransaksiController::class, 'transaksipdf'])->name('transaksi.pdf');
    Route::get('/datatransaksi/exportexcel', [TransaksiController::class, 'transaksiexcel'])->name('transaksi.excel');
    Route::get('/transaksi/kirim-email/{id}/{id_buku}/{id_anggota}/{denda}', [TransaksiController::class, 'kirim_email'])->name('transaksi.email');
});

//----Route group untuk halaman yang bisa diakses oleh Role Admin----//
Route::group(['middleware' => ['auth:user', 'cekrole:Admin']], function () {
    Route::resource('/pegawai', PegawaiController::class);
    Route::get('/pegawai/hapus/{id}', [PegawaiController::class, 'hapus'])->name('pegawai.hapus');
    Route::get('/datapegawai/exportpdf', [PegawaiController::class, 'cetak_pdf'])->name('pegawai.pdf');
    Route::get('/datapegawai/exportexcel', [PegawaiController::class, 'cetak_excel'])->name('pegawai.excel');
});

//----Route group untuk halaman yang bisa diakses oleh Role Anggota----//
Route::group(['middleware' => ['auth:anggota', 'cekrole:Anggota']], function () {
    Route::get('/home/anggota', [HomeController::class, 'homeanggota'])->name('home.anggota');
    Route::get('/databuku', [BukuController::class, 'bukuAnggota'])->name('buku.anggota');
    Route::get('/datatransaksi', [TransaksiController::class, 'transaksiAnggota'])->name('transaksi.anggota');
    Route::get('/editprofile-anggota', [AnggotaController::class, 'editProfileAnggota'])->name('anggota.edit-profile');
    Route::put('/updateprofile-anggota/{id}', [AnggotaController::class, 'updateProfile'])->name('anggota.updateprofile');
    Route::get('/ubahpassword-anggota', [AnggotaController::class, 'ubahPassword'])->name('anggota.ubahpassword');
    Route::put('/updatepassword-anggota', [AnggotaController::class, 'updatePassword'])->name('anggota.updatepassword');

    // Route::get('/anggota/editprofile', [AnggotaController::class, 'editProfileAnggota'])->name('anggota.edit-profile');
    // Route::put('/anggota/updateprofile/{id}', [AnggotaController::class, 'updateProfile'])->name('anggota.updateprofile');
});