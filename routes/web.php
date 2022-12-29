<?php

use App\Http\Livewire\Akun\Akun;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\DashboardUtama;
use App\Http\Livewire\Kas\KasDetailPage;
use App\Http\Livewire\Kas\KasPage;
use App\Http\Livewire\Kas\KasTransaksiPage;
use App\Http\Livewire\Master\AkunPage;
use App\Http\Livewire\Master\BankPage;
use App\Http\Livewire\Master\CatalogPage;
use App\Http\Livewire\Master\KategoriPage;
use App\Http\Livewire\Master\MerekPage;
use App\Http\Livewire\Master\Perusahaan;
use App\Http\Livewire\Master\PerusahaanPage;
use App\Http\Livewire\Master\RakPage;
use App\Http\Livewire\Master\SatuanPage;
use App\Http\Livewire\Master\Supplier;
use App\Http\Livewire\Master\SupplierPage;
use App\Http\Livewire\Produk\ProdukCreatePage;
use App\Http\Livewire\Produk\ProdukDiskonPage;
use App\Http\Livewire\Produk\ProdukEditPage;
use App\Http\Livewire\Produk\ProdukItemPage;
use App\Http\Livewire\Produk\ProdukSatuanPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::middleware(['isauth'])->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('customer', Login::class);
});


// Route::get('/', DashboardPageRingkasan::class);

Route::middleware(['islogin'])->group(function () {
    Route::get('/', DashboardUtama::class);

    Route::get('master/akun', AkunPage::class);
    Route::get('master/perusahaan', PerusahaanPage::class);
    Route::get('master/supplier', SupplierPage::class);
    // Route::get('master/bank', BankPage::class);
    Route::get('master/satuan', SatuanPage::class);
    Route::get('master/merek', MerekPage::class);

    Route::get('master/catalog', CatalogPage::class);

    Route::get('master/kategori', KategoriPage::class);
    Route::get('master/rak', RakPage::class);

    Route::get('kas/kas-ringkasan', KasPage::class);
    Route::get('kas/kas/{id}', KasDetailPage::class);
    Route::get('kas/kas-transaksi', KasTransaksiPage::class);

    Route::get('produk/produk-satuan', ProdukSatuanPage::class);
    Route::get('produk/produk-item', ProdukItemPage::class);
    Route::get('produk/produk-diskon', ProdukDiskonPage::class);

    Route::get('produk/produk-create', ProdukCreatePage::class);
    Route::get('produk/produk-edit/{id}', ProdukEditPage::class);
 
});
