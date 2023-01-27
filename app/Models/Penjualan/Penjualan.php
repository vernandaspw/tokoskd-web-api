<?php

namespace App\Models\Penjualan;

use App\Models\Kasir;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penjualan_item()
    {
        return $this->hasMany(PenjualanItem::class, 'penjualan_id', 'id');
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'kasir_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
