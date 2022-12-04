<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use App\Services\CheckValidityEmail;

class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id,$code)
    {

        $isValid = CheckValidityEmail::CheckLink($id,$code);
        if($isValid == 'user not found'){

            return redirect()
                ->route('loginForm')
                ->with('error','کاربر مورد نظر پیدا نشد.');
        }
        if ($isValid == 'link not valid'){

            return redirect()
                ->route('loginForm')
                ->with('error','لینک فعال سازی معتبر نمی باشد.');
        }
       if($isValid == 'link is valid'){
           session()->forget('newEmail');
           $decrypted = Crypt::decryptString($code);
           $user = User::where('id', $id)->where('code',$decrypted)->first();
           if($user->email_verified_at != null){
               return redirect()
                   ->route('login.form')
                   ->with('success','این ایمیل قبلا تایید شده.');
           }
           $user->email_verified_at = Date::now();
           $user->save();
           return redirect()
               ->route('login.form')
               ->with('success','حساب کاربری شما با موفقیت فعال شد.');
       }



    }

    public function resendEmailVerify(Request $request)
    {
        $code = Str::random();

        $user = User::where('email', $request->email)->first();
        $user->code = $code;
        $user->save();

        $encrypted = Crypt::encryptString($code);
        RegisterUserEvent::dispatch($user, $encrypted);
        session()->flash('success', 'ایمیل فعال سازی با موفقبت ارسال شد.');
        session()->put('newEmail', $user->email);
        return redirect()->back();
    }
}
