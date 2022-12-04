<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserDashboardController extends Controller
{
    //
    public function dashboard()
    {
        return view('front.profile.dashboard')
            ->with('user', Auth::user());
    }

    public function editProfile()
    {
        return view('front.profile.edit_profile')
            ->with('user', Auth::user());
    }

    public function updateProfile(Request $request)
    {
        $validate = $request->validate([
            'name' =>
                ['required', Rule::unique('users')->ignore(Auth::user()->id), 'exists:users', 'min:5', 'max:20'],
            'first_name' =>
                ['required', 'min:4', 'max:20'],
            'last_name' =>
                ['required', 'min:4', 'max:20']
        ], $messages = [
            'name.required' => 'نام کاربری الزامی است.',
            'name.unique' => 'نام کاربری تکراری است.',
            'name.min' => 'حداقل ۶ کاراکتر باشد.',
            'name.max' => 'حداکثر ۲۰ کاراکتر باشد.',

            'first_name.required' => 'نام الزامی است.',
            'first_name.min' => 'حداقل ۴ کاراکتر باشد.',
            'first_name.max' => 'حداکثر ۲۰ کاراکتر باشد.',

            'last_name.required' => 'نام خانوادگی الزامی است.',
            'last_name.min' => 'حداقل ۴ کاراکتر.',
            'last_name.max' => 'حداکثر ۲۰ کاراکتر باشد.',
        ]);
        try {

            $affected = DB::table('users')
                ->where('id', $request->user)
                ->update(['first_name' => $request->first_name,
                    'last_name' => $request->last_name]);
            session()->flash('success', 'بروز رسانی با موفقیت انجام شد.');

            return redirect()->back();

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


}
