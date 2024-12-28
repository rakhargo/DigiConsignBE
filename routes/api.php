<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', ProductController::class);
Route::apiResource('lokasi', LokasiController::class);
Route::apiResource('kategori', KategoriController::class);

// Rute untuk komentar
Route::get('product/{id}/komentar', [KomentarController::class, 'show']); // Mendapatkan komentar untuk produk tertentu
Route::post('product/{id}/komentar', [KomentarController::class, 'storeComment']); // Menyimpan komentar baru
Route::post('product/{id}/komentar/{komentarId}/reply', [KomentarController::class, 'storeReply']); // Menyimpan balasan komentar