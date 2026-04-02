<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth Routes (Authenticated only)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk — bulk-destroy harus SEBELUM resource agar tidak bentrok dengan {produk}
    Route::delete('/produk/bulk-destroy', [ProdukController::class, 'bulkDestroy'])->name('produk.bulk-destroy');
    Route::resource('produk', ProdukController::class);

    // Pelanggan
    Route::resource('pelanggan', PelangganController::class);

    // Penjualan
    Route::resource('penjualan', PenjualanController::class)->except(['edit', 'update']);

    // AJAX Routes
    Route::get('/api/produk/{produk}/info', [PenjualanController::class, 'getProdukInfo'])->name('api.produk.info');

    // faq

    

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
});