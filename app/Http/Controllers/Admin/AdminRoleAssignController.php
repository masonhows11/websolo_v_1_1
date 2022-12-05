<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleAssignController extends Controller
{
    //
    public function create(Request $request)
    {
        try {
            $user = Admin::findOrFail($request->user_id);
            $roles = Role::all();
            return view('dash.role_assign.role_assign')
                ->with(['user' => $user, 'roles' => $roles]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function store(Request $request)
    {
        try {
            $user = Admin::findOrFail($request->id);
            $user->syncRoles($request->roles);
            session()->flash('success','تخصیص با موفقیت انجام شد');
            return  redirect()->back();
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }
}
