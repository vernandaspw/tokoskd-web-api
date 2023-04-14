<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ModeKasir\ModeKasirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['authapi'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/me', [AuthController::class, 'me']);

    Route::get('modekasir/kasir', [ModeKasirController::class, 'kasir']);
    Route::post('modekasir/buka-kas-kasir', [ModeKasirController::class, 'buka_kas_kasir']);
    Route::post('modekasir/kasir-log-masuk', [ModeKasirController::class, 'kasir_log_masuk']);
    Route::post('modekasir/get-tutup-kas-kasir', [ModeKasirController::class, 'get_tutup_kas_kasir']);
    Route::post('modekasir/tutup-kas-kasir', [ModeKasirController::class, 'tutup_kas_kasir']);
    Route::post('modekasir/get-report', [ModeKasirController::class, 'get_report']);
    Route::post('modekasir/get-terima-kas-kasir', [ModeKasirController::class, 'get_terima_kas_kasir']);
    Route::post('modekasir/terima-kas-kasir', [ModeKasirController::class, 'terima_kas_kasir']);

    Route::get('modekasir/produk', [ModeKasirController::class, 'produk']);
    // Route::get('modekasir/cart', [ModeKasirController::class, 'cart']);
    // Route::post('modekasir/add-cart', [ModeKasirController::class, 'addCart']);

    // Bill
    Route::get('bill', [ModeKasirController::class, 'bill']);
    Route::post('bill-simpan', [ModeKasirController::class, 'simpanBill']);
    Route::post('bill-hapus', [ModeKasirController::class, 'hapusBill']);

    Route::post('riwayat-penjualan', [ModeKasirController::class, 'riwayatPenjualan']);
    Route::post('detail-penjualan', [ModeKasirController::class, 'detailPenjualan']);

    Route::post('modekasir/simpan-penjualan', [ModeKasirController::class, 'simpanPenjualan']);

});

Route::fallback(function () {
    return Resfor::error(null, 'api url tidak ada', 404);
});
