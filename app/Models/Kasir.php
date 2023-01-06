<?php

namespace App\Models;

use App\Models\Kas\Kas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kas()
    {
        return $this->belongsTo(Kas::class, 'kas_id', 'id');
    }
}
