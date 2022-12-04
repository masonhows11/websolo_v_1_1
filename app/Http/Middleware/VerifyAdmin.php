<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::Check()) {
             $auth_as_admin = Auth::user();
            if ($auth_as_admin->hasRole('admin') && $auth_as_admin->code_verified_at != null) {
                return $next($request);
            }
           return redirect()->route('home');
        }
        session()->flash('error','کاربر گرامی ابتدا وارد سایت شوید');
        return redirect()->route('admin.Login.form');

    }
}
