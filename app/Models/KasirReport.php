<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirReport extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'kasir_id', 'id');
    }

    public function buka_olehs()
    {
        return $this->belongsTo(User::class, 'buka_oleh');
    }
    public function tutup_olehs()
    {
        return $this->belongsTo(User::class, 'tutup_oleh');
    }
}
