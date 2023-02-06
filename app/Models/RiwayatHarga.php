<?php

namespace App\Models;

use App\Models\Pembelian\Pembelian;
use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHarga extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    public function produk_item()
    {
        return $this->belongsTo(ProdukItem::class, 'produk_item_id', 'id');
    }
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
    }
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id', 'id');
    }
    public function stok_transaksi()
    {
        return $this->belongsTo(StokTransaksi::class, 'pembelian_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
