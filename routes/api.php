<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', ProductController::class);
Route::apiResource('lokasi', LokasiController::class);
Route::apiResource('kategori', KategoriController::class);