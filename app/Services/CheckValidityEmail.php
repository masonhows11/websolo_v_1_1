<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CheckValidityEmail
{


    public static function CheckLink($id,$code)
    {


        try {
            $decrypted = Crypt::decryptString($code);
            $user = DB::table('users')
                ->where('code',$decrypted)
                ->where('id',$id)->first();
            if ($user){
                $expired = Carbon::parse($user->updated_at)->addMinutes(2)->isPast();
                if($expired == 1 ){
                    return 'link not valid';
                }
                return 'link is valid';
            }
            return 'user not found';
        }catch (\Exception $ex){
            return 'link is broken';
        }
    }

}
