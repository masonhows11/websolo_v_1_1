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
            'mobile' => ['required', 'exists:admins', new MobileValidationRule],
            'code' => ['required', 'digits:6']
        ], $messages = [
            'mobile.exists' => 'کاربری با شماره موبایل وارد شده وجود ندارد',
            'mobile.required' => 'شماره موبایل خود را وارد کنید',
            'code.required' => 'کد فعال سازی را وارد کنید',
            'code.digits' => 'کد فعال سازی باید معتبر نمی باشد',
        ]);

        $validated = CheckExpireToken::checkAdminToken($request->token, $request->email);
        if ($validated == false) {
            session()->flash('error', 'کد فعال سازی معتبر نمی باشد');
            session()->forget('admin_mobile');
            return redirect()->route('admin.Login.form');
        }
        if ($admin = Admin::where(['mobile' => $request->mobile, 'code' => $request->token])->first()) {

            Auth::guard('admin')->login($admin, $request->remember);
            session()->forget('admin_email');
            
            return redirect()->route('admin.dashboard');
        }
        session()->forget('admin_email');
        return redirect()->route('admin.Login.form');
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
