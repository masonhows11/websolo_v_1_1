<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    //

    public function registerForm()
    {
        return view('auth_front.register');
    }

    public function register(Request $request)
    {
          $request->validate([
            'name' =>
                ['required', 'unique:users', 'min:5', 'max:20'],
            'email' =>
                ['required', 'unique:users', 'email'],
            'password' =>
                ['required', 'min:6', 'max:30', 'confirmed']
        ], $messages = [
            'name.required' => 'نام کاربری الزامی است.',
            'name.unique' => 'نام کاربری تکراری است.',
            'name.min' => 'حداقل ۶ کاراکتر باشد.',
            'name.max' => 'حداکثر ۲۰ کاراکتر باشد.',

            'email.required' => 'ایمیل الزامی است.',
            'email.unique' => 'ایمیل تکراری است.',
            'email.email' => 'ایمیل معتبر نیست.',

            'password.required' => 'رمز عبور الزامی است.',
            'password.min' => 'حداقل ۶ کاراکتر.',
            'password.max' => 'جداکثر ۳۰ کاراکتر.',
            'password.confirmed' => 'رمز عبور و تکرار آن یکسان نیستند.',
        ]);
        try {
            $code = Str::random();
           $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'code' => $code
            ]);
           $encrypted = Crypt::encryptString($code);
            // step one
            // for execute event
            // run RegisterUserEvent with $user argument
            RegisterUserEvent::dispatch($user,$encrypted);
            session()->flash('success','ایمیل فعال سازی با موفقبت ارسال شد.');
            session()->put('newEmail',$user->email);
            return redirect()->route('email.verify.prompt');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
