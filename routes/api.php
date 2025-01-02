<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\AkunController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', ProductController::class);
Route::post('/product', [ProductController::class, 'store'])->middleware('auth:sanctum');


Route::apiResource('lokasi', LokasiController::class);
Route::apiResource('kategori', KategoriController::class);

// Rute untuk komentar
Route::get('product/{id}/komentar', [KomentarController::class, 'show']); // Mendapatkan komentar untuk produk tertentu
Route::post('product/{id}/komentar', [KomentarController::class, 'storeComment']); // Menyimpan komentar baru
Route::post('product/{id}/komentar/{komentarId}/reply', [KomentarController::class, 'storeReply']); // Menyimpan balasan komentar

// rute untuk login register page
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

