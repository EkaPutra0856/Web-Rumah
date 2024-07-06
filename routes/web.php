<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdministratorCRUDController;
use App\Http\Controllers\AdministratorSearchController;
use App\Http\Controllers\AdministratorImportExportController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\KKImportExportController;
use App\Http\Controllers\KKSearchController;
use App\Http\Controllers\RegionalAdminController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\RumahSearchController;
use App\Http\Controllers\RumahImportExportController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::get('/search-kelurahan_desa', [RegionController::class, 'searchKelurahanDesa'])->name('search.kelurahan_desa');


Route::get('/search-administrators', [AdministratorSearchController::class, 'search']);
Route::get('/export-PDF-administrators', [AdministratorImportExportController::class, 'exportPDF'])->name('export.pdf.administrators');

Route::get('/export-administrators', [AdministratorImportExportController::class, 'exportAdministrators'])->name('export.administrators');
Route::post('/import-administrators', [AdministratorImportExportController::class, 'importAdministrators'])->name('import.administrators');



Route::get('/', function () {
    return view('welcome');
});
Route::get('/map', [WebController::class, 'map'])->name('map');
Route::get('/map-region', [WebController::class, 'map_region']);

Route::get('/register', [AdministratorController::class, 'indexRegister']);
Route::get('/login-regadmin', [AdministratorController::class, 'loginFormRegAdmin']);
Route::post('/login-regadmin-post', [AdministratorController::class, 'loginRegAdmin']);

Route::get('/login', [AdministratorController::class, 'index'])->name('login');

Route::post('/register-administrator', [AdministratorController::class, 'register']);
Route::post('/login-administrator', [AdministratorController::class, 'login']);

Route::middleware('auth:administrators')->group(function () {
    Route::get('/dashboard', [AdministratorController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/wilayah', [RegionController::class, 'index']);
    Route::get('/adminwilayah', [RegionalAdminController::class, 'index']);
    Route::get('/admintable', [AdministratorCRUDController::class, 'index']);
});

Route::post('/logout', [AdministratorController::class, 'logout'])->name('admin.logout');


Route::get('/wilayah', [RegionController::class, 'index']);
Route::post('/insert-wilayah', [RegionController::class, 'insert']);
Route::post('/{id}/update-region', [RegionController::class, 'update']);
Route::post('/{id}/delete-region', [RegionController::class, 'delete']);
Route::get('/markers', [RegionController::class, 'getMarkers']);
Route::get('/export-wilayah', [RegionController::class, 'exportRegion']);
Route::get('/export-PDF-wilayah', [RegionController::class, 'exportPDF']);
Route::post('/wilayah-import', [RegionController::class, 'importRegion'])->name('import.region');
Route::get('/search-wilayah', [RegionController::class, 'search']);

Route::post('/insert-adminwilayah', [RegionalAdminController::class, 'insert']);
Route::post('/{id}/update-adminwilayah', [RegionalAdminController::class, 'update']);
Route::post('/{id}/delete-adminwilayah', [RegionalAdminController::class, 'delete']);
Route::get('/export-adminwilayah', [RegionalAdminController::class, 'exportRegionalAdmin']);
Route::get('/export-PDF-adminwilayah', [RegionalAdminController::class, 'exportPDF'])->name('export.pdf.adminwilayah');
Route::post('/import-adminwilayah', [RegionalAdminController::class, 'importRegionalAdmin']);
Route::get('/search-adminwilayah', [RegionalAdminController::class, 'search']);

Route::post('/insert-kk', [KKController::class, 'insert']);
Route::post('/check-nokk', [KKController::class, 'checkNoKK'])->name('check-nokk');
Route::post('/{id}/update-kk', [KKController::class, 'update']);
Route::post('/{id}/delete-kk', [KKController::class, 'delete']);
Route::get('/export-kk', [KKImportExportController::class, 'exportKK'])->name('export.kk');
Route::get('/export-PDF-kk', [KKImportExportController::class, 'exportPDF']);
Route::post('/import-kk', [KKImportExportController::class, 'importKK'])->name('import.kk');
Route::get('/search-kk', [KKSearchController::class, 'search'])->name('search-kk');

Route::post('/insert-rumah', [RumahController::class, 'insert']);
Route::post('/{id}/update-rumah', [RumahController::class, 'update']);
Route::post('/{id}/delete-rumah', [RumahController::class, 'delete']);
Route::get('/export-rumah', [RumahImportExportController::class, 'exportRumah'])->name('export.rumah');
Route::get('/export-PDF-rumah', [RumahImportExportController::class, 'exportPDF']);
Route::post('/import-rumah', [RumahImportExportController::class, 'importRumah'])->name('import.rumah');
Route::get('/search-rumah', [RumahSearchController::class, 'search']);

Route::post('/insert-administrator', [AdministratorCRUDController::class, 'insert']);
Route::post('/{id}/update-administrator', [AdministratorCRUDController::class, 'update']);
Route::post('/{id}/delete-administrator', [AdministratorCRUDController::class, 'delete']);

Route::middleware('auth:regadmin')->group(function () {
    Route::get('/dashboard-adminwilayah', [AdministratorController::class, 'adminwilayah'])->name('admin.dashboard');
    Route::get('/kk', [KKController::class, 'index']);
    Route::get('/rumah', [RumahController::class, 'index']);
});
