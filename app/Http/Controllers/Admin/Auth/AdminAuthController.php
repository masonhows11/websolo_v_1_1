<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminAuthNotification;
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
            'email' => ['required','exists:admins,email','email'],
        ],$messages =[
            'email.email' => 'ایمیل وارد شده معتبر نمی باشد',
            'email.exists' => 'کاربری با ایمیل  وارد شده وجود ندارد',
            'email.required' => 'ایمیل خود را وارد کنید',
        ]);

        try {
            $token = GenerateToken::generateToken();
            $admin = Admin::where('email',$request->email)->first();
            $admin->token = $token;
            $admin->save();

            $admin->notify( new AdminAuthNotification($token));

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
