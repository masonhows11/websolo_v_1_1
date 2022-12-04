<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    //
    public function profile()
    {
        return view('dash.profile.profile');
    }

    public function mobile()
    {
        return view('dash.profile.change_mobile');
    }
}
