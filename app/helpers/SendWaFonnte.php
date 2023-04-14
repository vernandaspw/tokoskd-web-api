<?php

namespace App\Helpers;

class SendWaFonnte
{
    protected static $response = [
        'phoneTarget' => null,
        'msg' => null
    ];
    public static function send($phoneTarget = '6289660741134', $msg = 'pesan gagal')
    {
        self::$response['phoneTarget'] = $phoneTarget;
        self::$response['msg']=$msg;

        if (strpos(substr(self::$response['phoneTarget'], 0, 3), '08') !== false) {
            $awal = str_replace("08", "628", substr(self::$response['phoneTarget'], 0, 3));
            self::$response['phoneTarget'] = $awal . substr(self::$response['phoneTarget'], 3);
        }
        $curl = curl_init();    
        $data = [
            'phone' => self::$response['phoneTarget'],
            'type' => 'text',
            'delay' => 0,
            'delay_req' => 0,
            'text' => self::$response['msg']
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization:". env('FONNTE_TOKEN'),
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://md.fonnte.com/api/send_message.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
