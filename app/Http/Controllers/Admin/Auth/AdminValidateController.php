<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;

use App\Rules\MobileValidationRule;
use App\Services\CheckExpireToken;
use App\Services\GenerateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminValidateController extends Controller
{
    //
    public function validateMobileForm()
    {
        return view('auth_dash.validate');
    }

    public function validateMobile(Request $request)
    {

        $request->validate([
            'email' => ['required', 'exists:admins'],
            'token' => ['required', 'digits:6']
        ], $messages = [
            'email.exists' => 'کاربری با ابمبل وارد شده وجود ندارد',
            'email.required' => 'ایمیل خود را وارد کنید',
            'token.required' => 'کد فعال سازی را وارد کنید',
            'token.digits' => 'کد فعال سازی باید معتبر نمی باشد',
        ]);

        $validated = CheckExpireToken::checkAdminToken($request->token, $request->email);

        if ($validated == false) {
            session()->flash('error', 'کد فعال سازی معتبر نمی باشد');
            session()->forget('admin_email');
            return redirect()->route('admin.login.form');
        } elseif ($validated == false) {
            $admin = Admin::where(['mobile' => $request->mobile, 'token' => $request->token])->first()
            Auth::guard('admin')->login($admin, $request->remember);
            session()->forget('admin_email');

            return redirect()->route('admin.dashboard');
        }
        session()->forget('admin_email');
        return redirect()->route('admin.login.form');
    }

    public function resendCode(Request $request)
    {

        try {
            $admin = Admin::where('email', $request->email)->first();
            $token = GenerateToken::generateToken();
            $admin->token = $token;
            $admin->save();

            return response()->json(['message' => 'کد فعال سازی مجددا ارسال شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'status' => 500], 500);
        }
    }
}
