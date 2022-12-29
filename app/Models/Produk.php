<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produk_item()
    {
        return $this->hasMany(ProdukItem::class, 'produk_id', 'id');
    }
    
    public function merek()
    {
        return $this->belongsTo(Merek::class, 'merek_id', 'id');
    }
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function rak()
    {
        return $this->belongsTo(Rak::class, 'rak_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }    
}
