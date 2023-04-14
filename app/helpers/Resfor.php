<?php

namespace App\Helpers;

class Resfor
{
    protected static $response = [
        'code' => 200,
        'status' => 'success',
        'msg' => null,
        'data' => null
    ];

    public static function success($data = null, $msg = null, $code = 200)
    {
        self::$response['data'] = $data;
        self::$response['msg'] = $msg;
        self::$response['code'] = $code;
        return response()->json(self::$response, self::$response['code']);
    }

    public static function error($data = null, $msg = null, $code = 400)
    {
        self::$response['status'] = 'error';
        self::$response['code'] = $code;
        self::$response['msg'] = $msg;
        self::$response['data'] = $data;
        return response()->json(self::$response, self::$response['code']);
    }
}