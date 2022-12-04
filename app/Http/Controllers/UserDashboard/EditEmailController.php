<?php

namespace App\Http\Controllers\UserDashboard;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CheckValidityEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EditEmailController extends Controller
{
    //
    public function editEmailForm()
    {
        return view('front.profile.edit_email')->with('user', Auth::user());
    }

    public function editEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users']
        ], $messages = [
            'email.required' => 'آدرس ایمیل الزامی است.',
            'email.email' => 'آدرس ایمیل وارد شده معتبر نمی باشد.',
            'email.unique' => 'آدرس ایمیل تکراری است.',
        ]);
        try {
            $user = User::where('email', Auth::user()->email)->first();;
            $code = Str::random();
            $user->email = $request->email;
            $user->updated_at = Carbon::now();
            $user->code = $code;
            $user->email_verified_at = null;
            $user->save();

            $encrypted = Crypt::encryptString($code);
            Auth::logout();
            $request->session()->invalidate();
            RegisterUserEvent::dispatch($user, $encrypted);

            session()->flash('success', 'ایمیل فعال سازی با موفقبت ارسال شد.');
            session()->put('newEmail', $user->email);
            return redirect()->route('email.verify.prompt');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }


    }

    public function verifyEditEmail($id, $code)
    {
        $isValid = CheckValidityEmail::CheckLink($id, $code);
        if ($isValid == 'user not found') {

            return redirect()
                ->route('loginForm')
                ->with('error', 'کاربر مورد نظر پیدا نشد.');
        }
        if ($isValid == 'link not valid') {

            return redirect()
                ->route('loginForm')
                ->with('error', 'لینک فعال سازی معتبر نمی باشد.');
        }
        if ($isValid == 'link is valid') {
            session()->forget('newEmail');
            $decrypted = Crypt::decryptString($code);
            $user = User::where('id', $id)->where('code', $decrypted)->first();
            if ($user->email_verified_at != null) {
                return redirect()
                    ->route('loginForm')
                    ->with('success', 'این ایمیل قبلا تایید شده.');
            }
            $user->email_verified_at = Date::now();
            $user->save();
            return redirect()
                ->route('loginForm')
                ->with('success', 'حساب کاربری شما با موفقیت فعال شد.');
        }
    }
}
