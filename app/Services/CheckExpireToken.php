<?php


namespace App\Services;


use App\Models\Admin;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class CheckExpireToken
{

    public static function checkAdminToken($code,$mobile)
    {
        try {
            $admin = Admin::where('mobile',$mobile)
                ->where('code',$code)
                ->first();
            $expired = Carbon::parse($admin->updated_at)->addMinutes(1)
                ->isPast();
            if($expired){
                return false;
            }
            $admin->code_verified_at = Date::now();
            $admin->save();
            return true;
        }catch (\Exception $ex){
            return view('errors_custom.validation_error')
                ->with(['error'=>$ex->getMessage()]);
        }
    }
}
