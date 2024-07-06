<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\WebController;

Route::get('/coordinates/{id}', [RegionController::class, 'coordinates']);
Route::get('/get-image-url/{imageName}', [RegionController::class, 'getImageUrl']);
Route::get('/regions', [RegionController::class, 'getRegions']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
