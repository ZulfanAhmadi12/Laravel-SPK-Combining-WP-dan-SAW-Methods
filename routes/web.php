<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternatifCriteriaDanSubController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SkorAlternatifController;
use App\Http\Controllers\SubKriteriaController;
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

Route::get('/', function () {
    return view('admin.index');
})->middleware('auth')->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard');
Route::post('/adminlogin', [AdminController::class, 'login'])->name('admin.login');

// Admin All Route
Route::controller(AdminController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/register', 'create')->name('register.admin');
    Route::post('/admin/register/account', 'store')->name('register.admin.account');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

// Kriteria Route
Route::controller(KriteriaController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/lihat/kriteria', 'LihatKriteria')->name('lihat.kriteria');

    Route::get('/tambah/kriteria', 'TambahKriteria')->name('tambah.kriteria');

    Route::get('/ubah/kriteria/{id}', 'UbahKriteria')->name('ubah.kriteria');
    Route::get('/hapus/kriteria/{id}', 'HapusKriteria')->name('hapus.kriteria');

    Route::post('/simpan/kriteria', 'SimpanKriteria')->name('simpan.kriteria');
    Route::post('/update/kriteria', 'UpdateKriteria')->name('update.kriteria');

});

// Alternatif Route
Route::controller(AlternatifController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/lihat/alternatif', 'LihatAlternatif')->name('lihat.alternatif');

    Route::get('/tambah/alternatif', 'TambahAlternatif')->name('tambah.alternatif');

    Route::get('/ubah/alternatif/{id}', 'UbahAlternatif')->name('ubah.alternatif');
    Route::get('/hapus/alternatif/{id}', 'HapusAlternatif')->name('hapus.alternatif');

    Route::post('/simpan/alternatif', 'SimpanAlternatif')->name('simpan.alternatif');
    Route::post('/update/alternatif', 'UpdateAlternatif')->name('update.alternatif');

});

// Sub-Kriteria Route
Route::controller(SubKriteriaController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/lihat/subkriteria', 'LihatSubkriteria')->name('lihat.subkriteria');

    Route::get('/tambah/subkriteria', 'TambahSubkriteria')->name('tambah.subkriteria');

    Route::get('/ubah/subkriteria/{id}', 'UbahSubkriteria')->name('ubah.subkriteria');
    Route::get('/hapus/subkriteria/{id}', 'HapusSubkriteria')->name('hapus.subkriteria');

    Route::post('/simpan/subkriteria', 'SimpanSubkriteria')->name('simpan.subkriteria');
    Route::post('/update/subkriteria', 'UpdateSubkriteria')->name('update.subkriteria');

});

// AlternatifCriteriaDanSub Route
Route::controller(AlternatifCriteriaDanSubController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/lihat/alternatifkriteria', 'LihatAlternatifKriteria')->name('lihat.alternatifkriteria');

    Route::get('/tambah/alternatifkriteria', 'TambahAlternatifKriteria')->name('tambah.alternatifkriteria');

    Route::get('/hapus/alternatifkriteria/{id}', 'HapusAlternatifKriteria')->name('hapus.alternatifkriteria');
    Route::get('/hitungskor/alternatif', 'HitungSkorAlternatif')->name('hitungskor.alternatif');

    Route::post('/simpan/alternatifkriteria', 'SimpanAlternatifKriteria')->name('simpan.alternatifkriteria');

});

// SkorAlternatif Route
Route::controller(SkorAlternatifController::class)->middleware(['auth', 'user-role:admin' ])->group(function() {
    Route::get('/lihat/skoralternatif', 'LihatSkorAlternatif')->name('lihat.skoralternatif');

    Route::get('/hapus/skoralternatif/{id}', 'HapusSkorAlternatif')->name('hapus.skoralternatif');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
