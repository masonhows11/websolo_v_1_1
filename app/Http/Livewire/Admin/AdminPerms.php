<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AdminPerms extends Component
{
    public $name;
    public $perm_id;
    public $edit_mode = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'unique:roles,name', 'min:2', 'max:30'],
        ];
    }

    protected $messages = [
        'name.required' => 'نام مجوز الزامی است',
        'name.unique' => 'نام مجوز تکراری است',
        'name.min' => 'حداقل ۲ کاراکتر وارد کنید',
        'name.max' => 'حداکثر تعداد کاراکتر مجاز',

    ];

    public function storePerm()
    {
        $this->validate();
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            if ($this->edit_mode == false)
            {
                Permission::create(['name' => $this->name]);
                session()->flash('success', 'نقش مورد نظر با موفقیت ایجاد شد');
                $this->name = '';
            }
            elseif ($this->edit_mode == true)
            {
                DB::table('permissions')
                    ->where('id', $this->perm_id)
                    ->update(['name' => $this->name]);
                $this->name = '';
                $this->edit_mode = false;
                session()->flash('success', 'نقش مورد نظر با موفقیت بروز رسانی شد');
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }

    }

    public function deletePerm($id)
    {
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            Permission::destroy($id);
            session()->flash('success', 'نقش مورد نظر با موفقیت حذف شد');
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function editPerm($id)
    {
        try {
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            $this->edit_mode = true;
            $perm = DB::table('permissions')->where('id', $id)->first();
            $this->name = $perm->name;
            $this->perm_id = $perm->id;
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }

    }

    public function render()
    {
        return view('livewire.admin.admin-perms')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['perms' => Permission::paginate(10)]);
    }
}
