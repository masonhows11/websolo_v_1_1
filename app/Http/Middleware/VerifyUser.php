<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth_user = DB::table('users')->where('email',Auth::user()->email)->first();
        if( $auth_user->email_verified_at == null ){
            return redirect()->route('login.form')->with('error','کاربر گرامی حساب کاربری شما فعال نشده است.');
        }

        return $next($request);
    }
}
