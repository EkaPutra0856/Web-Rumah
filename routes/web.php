<?php
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\RegAdminController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AdministratorController::class,'indexRegister']);


Route::get('/login', [AdministratorController::class,'index'])->name ('login');

Route::post('/register-administrator', [AdministratorController::class, 'register']);
Route::post('/login-administrator', [AdministratorController::class, 'login']);

Route::middleware('auth:administrators')->group(function () {
    Route::get('/dashboard', [AdministratorController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/wilayah', [RegionController::class, 'index']);
    Route::get('/adminwilayah', [RegAdminController::class, 'index']);
});

Route::post('/logout', [AdministratorController::class, 'logout'])->name('admin.logout');

Route::post('/insert-wilayah', [RegionController::class, 'insert']);
Route::post('/{id}/update-region', [RegionController::class, 'update']);
Route::post('/{id}/delete-region', [RegionController::class, 'delete']);


Route::post('/insert-adminwilayah', [RegAdminController::class, 'insert']);
Route::post('/{id}/update-adminwilayah', [RegAdminController::class, 'update']);
Route::post('/{id}/delete-adminwilayah', [RegAdminController::class, 'delete']);
