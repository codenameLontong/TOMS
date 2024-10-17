<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CabangController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/superadmin/dashboard', [HomeController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index'); // View all Cabangs

    Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create'); // Create Cabang page
    Route::post('/cabang/store', [CabangController::class, 'store'])->name('cabang.store'); // Store new Cabang

    Route::get('/cabang/{cabang}/edit', [CabangController::class, 'edit'])->name('cabang.edit'); // Edit Cabang page
    Route::put('/cabang/{cabang}', [CabangController::class, 'update'])->name('cabang.update'); // Update Cabang

    Route::get('/cabang/{cabang}/view', [CabangController::class, 'view'])->name('cabang.view'); // View a single Cabang

    Route::get('/cabang/{cabang}/delete', [CabangController::class, 'showdelete'])->name('cabang.showdelete');
    Route::delete('/cabang/{cabang}/delete', [CabangController::class, 'delete'])->name('cabang.delete'); // Delete Cabang

});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::resource('pegawai', PegawaiController::class);

Route::get('pegawai/{pegawai}/mutasi', [PegawaiController::class, 'mutasi'])->name('pegawai.mutasi');
Route::put('pegawai/{pegawai}/mutasi', [PegawaiController::class, 'updateMutasi'])->name('pegawai.updateMutasi');

Route::get('pegawai/{pegawai}/view', [PegawaiController::class, 'view'])->name('pegawai.view');

Route::get('pegawai/{pegawai}/update', [PegawaiController::class, 'showupdate'])->name('pegawai.showupdate');
Route::put('pegawai/{pegawai}/update', [PegawaiController::class, 'update'])->name('pegawai.update');

Route::get('/pegawai/showimport', [PegawaiController::class, 'showimport'])->name('pegawai.showimport');

Route::post('/pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);

Route::get('/pegawai/{pegawai}/terminate', [PegawaiController::class, 'showterminate'])->name('pegawai.showterminate');
Route::put('pegawai/{pegawai}/terminate', [PegawaiController::class, 'terminate'])->name('pegawai.terminate');

Route::get('/cabang/showimport', [CabangController::class, 'showimport'])->name('cabang.showimport');
Route::post('/cabang/import', [CabangController::class, 'import'])->name('cabang.import');

Route::get('/pegawai/check-nrp', [PegawaiController::class, 'checkNrp'])->name('pegawai.checkNrp');
Route::get('/pegawai/check-email', [PegawaiController::class, 'checkEmail'])->name('pegawai.checkEmail');

Route::get('/cabang/check-kode', [CabangController::class, 'checkKodeCabang'])->name('cabang.checkKodeCabang');



require __DIR__.'/auth.php';
