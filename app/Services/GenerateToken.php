<?php


namespace App\Services;


use App\Models\Admin;

class GenerateToken
{
    public static function generateToken()
    {
        $code = mt_rand(111111, 999999);
        if (self::existToken($code)) {
            return mt_rand(111111, 999999);
        }
        return $code;

    }

    public static function existToken($token)
    {
        return Admin::where('token', $token)->exists();
    }
}
