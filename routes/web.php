<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DirectorateController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\OvertimeController;
use App\Models\Overtime;
use App\Http\Controllers\AppraisalController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/superadmin/dashboard', [HomeController::class, 'index'])->name('superadmin.dashboard');

    Route::get('/password/update', [PegawaiController::class, 'showUpdatePassword'])->name('password.showUpdatePassword');
    Route::put('/password/update', [PegawaiController::class, 'updatePassword'])->name('password.updatePassword');


    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/check-email', [PegawaiController::class, 'checkEmail'])->name('pegawai.checkEmail');
    Route::get('/pegawai/showimport', [PegawaiController::class, 'showimport'])->name('pegawai.showimport');


    Route::get('pegawai/{pegawai}/mutasi', [PegawaiController::class, 'mutasi'])->name('pegawai.mutasi');
    Route::put('pegawai/{pegawai}/mutasi', [PegawaiController::class, 'updateMutasi'])->name('pegawai.updateMutasi');

    // Routes for AJAX requests
    Route::get('/get-directorates/{companyId}', [PegawaiController::class, 'getDirectorates']);
    Route::get('/get-divisions/{directorateId}', [PegawaiController::class, 'getDivisions']);
    Route::get('/get-departments/{divisionId}', [PegawaiController::class, 'getDepartments']);
    Route::get('/get-sections/{departmentId}', [PegawaiController::class, 'getSections']);

    // CABANG
    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index'); // View all Cabangs
    Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create'); // Create Cabang page
    Route::post('/cabang/store', [CabangController::class, 'store'])->name('cabang.store'); // Store new Cabang
    Route::get('/cabang/{cabang}/edit', [CabangController::class, 'edit'])->name('cabang.edit'); // Edit Cabang page
    Route::put('/cabang/{cabang}', [CabangController::class, 'update'])->name('cabang.update'); // Update Cabang
    Route::get('/cabang/{cabang}/view', [CabangController::class, 'view'])->name('cabang.view'); // View a single Cabang
    Route::delete('/cabang/{cabang}/delete', [CabangController::class, 'delete'])->name('cabang.delete'); // Delete Cabang
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

    // OVERTIME
    Route::resource('overtime', OvertimeController::class);
    Route::get('/overtime/create', [OvertimeController::class, 'create'])->name('overtime.create');
    Route::post('/overtime', [OvertimeController::class, 'store'])->name('overtime.store');
    Route::get('/search-pegawais', [OvertimeController::class, 'search'])->name('search.pegawais');
    Route::get('/overtime/{id}', [OvertimeController::class, 'show'])->name('overtime.show');
    Route::get('/overtime/{id}/edit', [OvertimeController::class, 'edit'])->name('overtime.edit');
    Route::put('/overtime/{id}', [OvertimeController::class, 'update'])->name('overtime.update');
    Route::post('/overtime/{id}/approve', [OvertimeController::class, 'approve'])->name('overtime.approve');
    Route::post('/overtime/{id}/reject', [OvertimeController::class, 'reject'])->name('overtime.reject');
    Route::post('/overtime/{id}/verify', [OvertimeController::class, 'verify'])->name('overtime.verify');
    Route::post('/overtime/{id}/confirm', [OvertimeController::class, 'confirm'])->name('overtime.confirm');

    // VENDOR
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index'); // View all Vendors
    Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create'); // Create Vendor page
    Route::post('/vendor/store', [VendorController::class, 'store'])->name('vendor.store'); // Store new Vendor
    Route::get('/vendor/{vendor}/edit', [VendorController::class, 'edit'])->name('vendor.edit'); // Edit Vendor page
    Route::put('/vendor/{vendor}', [VendorController::class, 'update'])->name('vendor.update'); // Update Vendor
    Route::get('/vendor/{vendor}/view', [VendorController::class, 'view'])->name('vendor.view'); // View a single Vendor
    Route::delete('/vendor/{vendor}/delete', [VendorController::class, 'delete'])->name('vendor.delete'); // Delete Vendor

    // STRUCTURE
    Route::get('/structure', [StructureController::class, 'index'])->name('structure.index'); // View all structures

    // DIRECTORATE
    Route::get('/directorate', [DirectorateController::class, 'index'])->name('directorate.index'); // View all directorates
    Route::get('/directorate/create', [DirectorateController::class, 'create'])->name('directorate.create'); // Create directorate page
    Route::post('/directorate/store', [DirectorateController::class, 'store'])->name('directorate.store'); // Store new directorate
    Route::get('/directorate/{directorate}/edit', [DirectorateController::class, 'edit'])->name('directorate.edit'); // Edit directorate page
    Route::put('/directorate/{directorate}', [DirectorateController::class, 'update'])->name('directorate.update'); // Update directorate
    Route::get('/directorate/{directorate}/view', [DirectorateController::class, 'view'])->name('directorate.view'); // View a single directorate
    Route::delete('/directorate/{directorate}/delete', [DirectorateController::class, 'delete'])->name('directorate.delete'); // Delete directorate
    Route::get('/directorate/check-nama-directorate', [DirectorateController::class, 'checkNamaDirectorate'])->name('directorate.checkNamaDirectorate');
    Route::get('/get-directorates-by-company', [DirectorateController::class, 'getDirectoratesByCompany'])->name('getDirectoratesByCompany');

    // DIVISION
    Route::get('/division', [DivisionController::class, 'index'])->name('division.index'); // View all divisions
    Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create'); // Create division page
    Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store'); // Store new division
    Route::get('/division/{division}/edit', [DivisionController::class, 'edit'])->name('division.edit'); // Edit division page
    Route::put('/division/{division}', [DivisionController::class, 'update'])->name('division.update'); // Update division
    Route::get('/division/{division}/view', [DivisionController::class, 'view'])->name('division.view'); // View a single division
    Route::delete('/division/{division}/delete', [DivisionController::class, 'delete'])->name('division.delete'); // Delete division
    Route::get('/division/check-nama-division', [DivisionController::class, 'checkNamaDivision'])->name('division.checkNamaDivision');

    // DEPARTMENT
    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index'); // View all departments
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create'); // Create department page
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store'); // Store new department
    Route::get('/department/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit'); // Edit department page
    Route::put('/department/{department}', [DepartmentController::class, 'update'])->name('department.update'); // Update department
    Route::get('/department/{department}/view', [DepartmentController::class, 'view'])->name('department.view'); // View a single department
    Route::delete('/department/{department}/delete', [DepartmentController::class, 'delete'])->name('department.delete'); // Delete department
    Route::get('/department/check-nama-department', [DepartmentController::class, 'checkNamaDepartment'])->name('department.checkNamaDepartment');

    // SECTION
    Route::get('/section', [SectionController::class, 'index'])->name('section.index'); // View all sections
    Route::get('/section/create', [SectionController::class, 'create'])->name('section.create'); // Create section page
    Route::post('/section/store', [SectionController::class, 'store'])->name('section.store'); // Store new section
    Route::get('/section/{section}/edit', [SectionController::class, 'edit'])->name('section.edit'); // Edit section page
    Route::put('/section/{section}', [SectionController::class, 'update'])->name('section.update'); // Update section
    Route::get('/section/{section}/view', [SectionController::class, 'view'])->name('section.view'); // View a single section
    Route::delete('/section/{section}/delete', [SectionController::class, 'delete'])->name('section.delete'); // Delete section
    Route::get('/section/check-nama-section', [SectionController::class, 'checkNamaSection'])->name('section.checkNamaSection');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::resource('pegawai', PegawaiController::class);

Route::get('pegawai/{pegawai}/view', [PegawaiController::class, 'view'])->name('pegawai.view');

Route::get('pegawai/{pegawai}/update', [PegawaiController::class, 'showupdate'])->name('pegawai.showupdate');
Route::put('pegawai/{pegawai}/update', [PegawaiController::class, 'update'])->name('pegawai.update');


//APPRAISAL
Route::get('/appraisal', [AppraisalController::class, 'index'])->name('appraisal.index');
Route::get('/appraisal/create', [AppraisalController::class, 'create'])->name('appraisal.create');
Route::get('/appraisal/category', [AppraisalController::class, 'category'])->name('appraisal.category');
Route::get('/appraisal/createcategory', [AppraisalController::class, 'createcategory'])->name('appraisal.createcategory');
Route::post('/appraisal/storecategory', [AppraisalController::class, 'storecategory'])->name('appraisal.storecategory');
Route::put('appraisal/{appraisalcategorys}/updatecategory', [AppraisalController::class, 'updatecategory'])->name('appraisal.updatecategory');
Route::get('/appraisal/{appraisalcategorys}/showupdatecategory', [AppraisalController::class, 'showupdatecategory'])->name('appraisal.showupdatecategory');
Route::post('/appraisal/storeappraisal', [AppraisalController::class, 'storeappraisal'])->name('appraisal.storeappraisal');
Route::get('/appraisal/{appraisal}/createappraisalemployee', [AppraisalController::class, 'createappraisalemployee'])->name('appraisal.createappraisalemployee');
Route::post('/appraisal/storeappraisalemployee', [AppraisalController::class, 'storeappraisalemployee'])->name('appraisal.storeappraisalemployee');
Route::get('/appraisal/{appraisal}/showappraisalemployee', [AppraisalController::class, 'createappraisalemployee'])->name('appraisal.showappraisalemployee');
Route::get('/appraisal/{appraisalsEmployee}/updateappraisalemployee', [AppraisalController::class, 'updateappraisalemployee'])->name('appraisal.updateappraisalemployee');

Route::put('appraisal/{appraisal}/updateappraisalitem', [AppraisalController::class, 'updateappraisalitem'])->name('appraisal.updateappraisalitem');



Route::post('/pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);

Route::put('pegawai/{pegawai}/terminate', [PegawaiController::class, 'terminate'])->name('pegawai.terminate');

Route::get('/cabang/showimport', [CabangController::class, 'showimport'])->name('cabang.showimport');
Route::post('/cabang/import', [CabangController::class, 'import'])->name('cabang.import');

Route::get('/vendor/showimport', [VendorController::class, 'showimport'])->name('vendor.showimport');
Route::post('/vendor/import', [VendorController::class, 'import'])->name('vendor.import');

Route::get('/cabang/check-kode', [CabangController::class, 'checkKodeCabang'])->name('cabang.checkKodeCabang');
Route::get('/vendor/check-kode', [VendorController::class, 'checkKodeVendor'])->name('vendor.checkKodeVendor');








require __DIR__ . '/auth.php';
