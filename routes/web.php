<?php

use App\Http\Controllers\StrukBillController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\StrukKasirLaporanTutupKas;
use App\Http\Livewire\Akun\Akun;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\DashboardHari;
use App\Http\Livewire\Dashboard\DashboardUtama;
use App\Http\Livewire\Hutang\HutangPage;
use App\Http\Livewire\Hutang\HutangPelangganPage;
use App\Http\Livewire\Hutang\HutangSupplierPage;
use App\Http\Livewire\Kas\KasDetailPage;
use App\Http\Livewire\Kas\KasPage;
use App\Http\Livewire\Kas\KasTransaksiPage;
use App\Http\Livewire\Master\AkunPage;
use App\Http\Livewire\Master\BankPage;
use App\Http\Livewire\Master\CatalogPage;
use App\Http\Livewire\Master\KategoriPage;
use App\Http\Livewire\Master\MerekPage;
use App\Http\Livewire\Master\PelangganPage;
use App\Http\Livewire\Master\Perusahaan;
use App\Http\Livewire\Master\PerusahaanPage;
use App\Http\Livewire\Master\RakPage;
use App\Http\Livewire\Master\SatuanPage;
use App\Http\Livewire\Master\Supplier;
use App\Http\Livewire\Master\SupplierPage;
use App\Http\Livewire\Penjualan\KasirDetailPage;
use App\Http\Livewire\Penjualan\KasirPage;
use App\Http\Livewire\Penjualan\PenjualanPage;
use App\Http\Livewire\Piutang\PiutangPage;
use App\Http\Livewire\Piutang\PiutangPelangganPage;
use App\Http\Livewire\Piutang\PiutangSupplierPage;
use App\Http\Livewire\Produk\ProdukCreatePage;
use App\Http\Livewire\Produk\ProdukDiskonPage;
use App\Http\Livewire\Produk\ProdukEditPage;
use App\Http\Livewire\Produk\ProdukItemPage;
use App\Http\Livewire\Produk\ProdukRiwayatHargaPage;
use App\Http\Livewire\Produk\ProdukSatuanPage;
use App\Http\Livewire\Produk\ProdukStokDetail;
use App\Http\Livewire\Produk\ProdukStokPage;
use App\Models\AppModel;
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

Route::get('/backup-db', function()
{
    \Artisan::call('backup:run --only-db');
    echo 'backup db complete';
    // kirim email
});
Route::get('/backup-clean', function()
{
    $cek = \Artisan::call('backup:clean');
    if ($cek) {
        echo 'clear backup success';
    }else {
        echo 'clear backup failed!';
    }
    // $storage = Storage::disk('local');
    // if ($storage) {
    //     foreach ($storage->allFiles('tokoskd') as $filePathname) {
    //         $storage->delete($filePathname);
    //     }
    // }
});
Route::get('/backup-clear', function()
{
    $storage = Storage::disk('local');
    if ($storage) {
        foreach ($storage->allFiles('tokoskd') as $filePathname) {
            $storage->delete($filePathname);
        }
    }
    echo 'clear data backup success';
});
Route::get('/backup-send-email', function()
{
    // kirim data ke email

    // $storage = Storage::disk('local');
    // if ($storage) {
    //     foreach ($storage->allFiles('tokoskd') as $filePathname) {
    //         $storage->delete($filePathname);
    //     }
    // }
    echo 'kirim data backup success';
});




// Route::get('/', DashboardPageRingkasan::class);

Route::middleware(['islogin'])->group(function () {
    Route::get('/', DashboardUtama::class);
    Route::get('/hari', DashboardHari::class);

    Route::get('master/akun', AkunPage::class);
    Route::get('master/perusahaan', PerusahaanPage::class);
    Route::get('master/supplier', SupplierPage::class);
    Route::get('master/pelanggan', PelangganPage::class);
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


    Route::get('produk/produk-create', ProdukCreatePage::class);
    Route::get('produk/produk-edit/{id}', ProdukEditPage::class);

    Route::get('produk/produk-diskon', ProdukDiskonPage::class);
    Route::get('produk/produk-stok', ProdukStokPage::class);
    // Route::get('produk/produk-terjual', ProdukStokPage::class);
    Route::get('produk/produk-stok-detail/{id}', ProdukStokDetail::class);

    Route::get('penjualan', PenjualanPage::class);

    Route::get('penjualan/kasir', KasirPage::class);
    Route::get('penjualan/kasir/{id}', KasirDetailPage::class);

    Route::get('produk/riwayat-harga', ProdukRiwayatHargaPage::class);

    Route::get('hutang', HutangPage::class);
    Route::get('hutang/hutang-pelanggan', HutangPelangganPage::class);
    Route::get('hutang/hutang-supplier', HutangSupplierPage::class);

    Route::get('piutang', PiutangPage::class);
    Route::get('piutang/piutang-pelanggan', PiutangPelangganPage::class);
    Route::get('piutang/piutang-supplier', PiutangSupplierPage::class);


    Route::get('penjualan/struk/{id}', [StrukController::class, 'index'])->name('struk');
    Route::get('penjualan/struk/kasir/tutup/{id}', [StrukKasirLaporanTutupKas::class, 'index']);
    Route::get('penjualan/struk/bill/{id}', [StrukBillController::class, 'index']);
});
