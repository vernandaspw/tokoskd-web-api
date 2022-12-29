<?php

namespace App\Models\Kas;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasTransaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kas()
    {
        return $this->belongsTo(Kas::class, 'kas_id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(KasTJenis::class, 'kas_t_jenis_id', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(KasTKategori::class, 'kas_t_kategori_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
