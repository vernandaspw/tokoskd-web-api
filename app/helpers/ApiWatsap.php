<?php

namespace App\Helpers;

class ApiWatsap
{
    protected static $response = [
        'phoneTarget' => null,
        'msg' => null,
    ];
    public static function send($phoneTarget = '6289660741134', $msg = 'pesan gagal')
    {
        $api_key = '06d0a52abbd209727dfb1e72d1b9bc85036fa717';
        $id_device = '717';
        $url = 'https://api.watsap.id/send-message';
        $no_hp = self::$response['phoneTarget'] = $phoneTarget;
        $pesan = self::$response['msg'] = $msg;

        // if (strpos(substr($no_hp, 0, 3), '08') !== false) {
        //     $awal = str_replace("08", "628", substr($no_hp, 0, 3));
        //     $no_hp = $awal . substr($no_hp, 3);
        // }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp' => $no_hp,
            'pesan' => $pesan,
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($curl);
        $response = curl_close($curl);
        // dd($response);
        // echo $response;
    }
}
