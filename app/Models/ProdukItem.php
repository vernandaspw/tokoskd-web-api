<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    
    // public function merek()
    // {
    //     return $this->belongsTo(Merek::class, 'merek_id', 'id');
    // }
}
