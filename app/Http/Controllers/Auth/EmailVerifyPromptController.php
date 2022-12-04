<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerifyPromptController extends Controller
{
    //
    public function verifyEmailPrompt()
    {
        return view('auth_front.verify_email_prompt');
    }
}
