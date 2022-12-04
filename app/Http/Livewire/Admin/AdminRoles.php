<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminRoles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $role_id;
    public $edit_mode = false;
    protected function rules()
    {
        return [
            'name' => ['required', 'unique:roles,name', 'min:2', 'max:30'],
        ];
    }
    protected $messages = [
        'name.required' => 'نام نقش الزامی است',
        'name.unique' => 'نام نقش تکراری است',
        'name.min' => 'حداقل ۲ کاراکتر وارد کنید',
        'name.max' => 'حداکثر تعداد کاراکتر مجاز',

    ];
    public function storeRole()
    {
        $this->validate();
        if($this->edit_mode == false){
            try {
                Role::create(['name' => $this->name]);
                session()->flash('success', 'نقش مورد نظر با موفقیت ایجاد شد');
                $this->name = '';
            }catch (\Exception $ex){
                return view('errors_custom.model_store_error');
            }
        }elseif ( $this->edit_mode == true){
            DB::table('roles')
                ->where('id',$this->role_id)
                ->update(['name'=>$this->name]);
            $this->name = '';
            $this->edit_mode = false;
            session()->flash('success', 'نقش مورد نظر با موفقیت بروز رسانی شد');
        }
    }

    public function deleteRole($id)
    {
        try {
            Role::destroy($id);
            session()->flash('success', 'نقش مورد نظر با موفقیت حذف شد');
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function editRole($id)
    {
        $this->edit_mode = true;
        $role = DB::table('roles')->where('id',$id)->first();
        $this->name = $role->name;
        $this->role_id = $role->id;
    }

    public function render()
    {
        return view('livewire.admin.admin-roles')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['roles' => Role::paginate(10)]);
    }
}
