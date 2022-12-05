<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

        $auth_admin = DB::table('admins')->where('mobile',Auth::guard('admin')->user()->mobile)->first();
        if( $auth_admin->token_verified_at == null )
        {
            return  redirect()->route('admin.login.form')
                ->with(['error','کاربر گرامی ابتدا وارد سایت شوید.']);
        }

        return $next($request);

    }
}
