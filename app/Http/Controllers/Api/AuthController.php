<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // cek hp
        $phone = User::where('phone', request('phone'))->first();
        if ($phone) {
            if (Hash::check(request('password'), $phone->password)) {
                $token = auth('api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($phone);

                return Resfor::success([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL(),
                    'userId' => auth('api')->user()->id,
                    'userRole' => auth('api')->user()->role,
                    'userNama' => auth('api')->user()->nama
                ], 'success');
            } else {
                return Resfor::error(['password' => 'password salah'], 'password salah', 401);
            }
        } else {
            return Resfor::error(['phone' => 'no hp salah'], 'no HP salah', 401);
        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        if (auth('api')->user()) {
            return Resfor::success(auth('api')->user(), 'success');
        }else {
            return Resfor::error(auth('api')->user(), 'error');
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return Resfor::success(null, 'Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return Resfor::success([
            'nama' => auth('api')->user()->nama,
            'role' => auth('api')->user()->role,
            'token' => auth('api')->setTTL(env('JWT_REFRESH_EXPIRED'))->refresh()
        ], 'success');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
