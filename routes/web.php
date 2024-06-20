<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdministratorCRUDController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\RegionalAdminController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\RumahExportController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\ImportExportKKController;

Route::get('/export-administrators', [ImportExportController::class, 'exportAdministrators'])->name('export.administrators');
Route::post('/import-administrators', [ImportExportController::class, 'importAdministrators'])->name('import.administrators');

Route::get('/export-rumah', [RumahExportController::class, 'exportRumah'])->name('export.rumah');
Route::post('/import-rumah', [RumahExportController::class, 'importRumah'])->name('import.rumah');


Route::get('/export-kk', [ImportExportKKController::class, 'exportKK'])->name('export.kk');
Route::post('/import-kk', [ImportExportKKController::class, 'importKK'])->name('import.kk');


Route::get('/', function () {
    return view('welcome');
});
Route::get('/map', [WebController::class, 'map'])->name('map');

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
Route::get('/wilayah-export', [RegionController::class, 'export']);
Route::post('/wilayah-import', [RegionController::class, 'import'])->name('import.region');


Route::post('/insert-adminwilayah', [RegionalAdminController::class, 'insert']);
Route::post('/{id}/update-adminwilayah', [RegionalAdminController::class, 'update']);
Route::post('/{id}/delete-adminwilayah', [RegionalAdminController::class, 'delete']);
Route::get('/export-adminwilayah', [RegionalAdminController::class, 'export']);

Route::post('/insert-kk', [KKController::class, 'insert']);
Route::post('/{id}/update-kk', [KKController::class, 'update']);
Route::post('/{id}/delete-kk', [KKController::class, 'delete']);

Route::post('/insert-rumah', [RumahController::class, 'insert']);
Route::post('/{id}/update-rumah', [RumahController::class, 'update']);
Route::post('/{id}/delete-rumah', [RumahController::class, 'delete']);

Route::post('/insert-administrator', [AdministratorCRUDController::class, 'insert']);
Route::post('/{id}/update-administrator', [AdministratorCRUDController::class, 'update']);
Route::post('/{id}/delete-administrator', [AdministratorCRUDController::class, 'delete']);

Route::middleware('auth:regadmin')->group(function () {
    Route::get('/dashboard-adminwilayah', [AdministratorController::class, 'adminwilayah'])->name('admin.dashboard');
    Route::get('/kk', [KKController::class, 'index']);
    Route::get('/rumah', [RumahController::class, 'index']);
});
