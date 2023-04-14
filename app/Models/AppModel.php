<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use HasFactory;

    public static function getIP()
    {

        $ip = request()->server('SERVER_ADDR');
        // $ip = '';

        $data = [
            'ip' => $ip,
            'url' => '/tokoskd/public',
            'app_url' => 'http://' . $ip . env('SUB_URL'),
        ];

        return $data;
    }

    public static function pajak()
    {
        // dalam persen
        $persen = 0;
        return $persen;
    }

}
