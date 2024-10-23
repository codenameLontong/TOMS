<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\OvertimeController;
use App\Models\Overtime;

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
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::resource('overtime', OvertimeController::class);
    Route::get('/overtime/create', [OvertimeController::class, 'create'])->name('overtime.create');
    Route::post('/overtime', [OvertimeController::class, 'store'])->name('overtime.store');
    Route::get('/search-pegawais', [OvertimeController::class, 'search'])->name('search.pegawais');
    Route::get('/overtime/{id}', [OvertimeController::class, 'show'])->name('overtime.show');
    Route::get('/overtime/{id}/edit', [OvertimeController::class, 'edit'])->name('overtime.edit');
    Route::put('/overtime/{id}', [OvertimeController::class, 'update'])->name('overtime.update');

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

Route::delete('/pegawai/{id}/terminate', [PegawaiController::class, 'terminate'])->name('pegawai.terminate');

require __DIR__ . '/auth.php';
