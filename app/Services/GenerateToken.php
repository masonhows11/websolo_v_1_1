<?php


namespace App\Services;


use App\Models\Admin;

class GenerateToken
{
    public static function  generateToken()
    {
        $activation_token = mt_rand(111111,999999);

        if (self::existToken($activation_token)) {

            return  mt_rand(111111,999999);
        }
        return $activation_token;

    }

    public static function existToken($token)
    {
        return Admin::where('token', $token)->exists();
    }
}
