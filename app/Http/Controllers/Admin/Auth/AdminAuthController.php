<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;

use App\Rules\MobileValidationRule;
use App\Services\GenerateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{


    public function loginAdminForm()
    {
     return view('auth_dash.login');
    }

    public function loginAdmin(Request $request){

        $request->validate([
            'mobile' => ['required','exists:admins,mobile',new MobileValidationRule],
        ],$messages =[
            'mobile.exists' => 'کاربری با ایمیل  وارد شده وجود ندارد',
            'mobile.required' => 'شماره موبایل خود را وارد کنید',
        ]);

        try {
            $code = GenerateToken::generateToken();
            $admin = Admin::where('email',$request->email)->first();
            $admin->code = $code;
            $admin->save();

            session(['admin_email'=>$admin->email]);


            session()->flash('success', 'کد فعال سازی به ایمیل ارسال شد');
            return redirect()->route('admin.validate.mobile.form');
        }catch (\Exception $ex)
        {
            return $ex->getMessage();
        }
    }

    public function logOut(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->token = null;
        $admin->code_verified_at = null;
        $admin->remember_token = null;
        $admin->save();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login.form');
    }

}
