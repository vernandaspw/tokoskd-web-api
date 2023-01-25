<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use HasFactory;

    public static function getIP()
    {
        $ip = $_SERVER['SERVER_ADDR'];


        $data = [
           'ip' => $ip,
           'url' => '/tokoskd/public',
           'app_url' => 'http://'.$ip.'/tokoskd/public',
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
