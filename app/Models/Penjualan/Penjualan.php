<?php

namespace App\Models\Penjualan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penjualan_item()
    {
        return $this->hasMany(PenjualanItem::class, 'penjualan_item_id', 'id');
    }
}
