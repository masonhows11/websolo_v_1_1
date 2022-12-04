<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ChangePasswordController extends Controller
{
    //
    public function create()
    {

        return view('front.profile.edit_password')
            ->with(['user' => Auth::user()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'min:6', 'string', 'max:30', 'confirmed']
        ], $messages = [
            'email.required' => ['آدرس ایمیل الزامی است'],
            'email.email' => ['ایمیل وارد شده نامعتیر است'],

            'oldPassword.required' => ['رمز عبور قبلی خود را وارد کنید'],
            'newPassword.required' => ['رمز عبور جدید را وارد کنید'],

            'newPassword.min' => ['حداقل ۶ کاراکتز وارد کنید'],
            'newPassword.max' => ['حداکثز ۳۰ کاراکتز وارد کنید'],
            'newPassword.string' => ['رمز عبور انتخابی رشته متنی باشد'],
            'newPassword.confirmed' => ['رمز عبور جدید و تکرار آن یکسان نیستند']
        ]);
        if (Auth::user()->email !== $request->email) {
            return redirect()->back()->with(['error' => 'ایمیل وارد شده نامعتبر است']);
        }
        $old_password = User::where('email', $request->email)->first();
        if (!Hash::check(trim($request->oldPassword), $old_password->password)) {
            return redirect()->back()->with(['error' => 'رمز عبور قبلی اشتباه است']);
        }
        if ($request->oldPassword === trim($request->newPassword)) {
            return redirect()->back()->with(['error' => 'رمز عبور جدید انتخابی تکراری است']);
        }
        DB::transaction(function () use ($request) {
            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->newPassword)]);
        });
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }
}
