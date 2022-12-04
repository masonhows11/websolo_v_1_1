<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemoveAccountController extends Controller
{
    //
    public function destroy(Request $request)
    {

        $auth = Auth::user();
        Auth::logout();
        User::where('email',$auth->email)->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
