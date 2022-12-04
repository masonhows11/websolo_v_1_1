<?php

namespace App\Http\Livewire\Admin;


use App\Notifications\AdminAuthNotification;
use App\Rules\MobileValidationRule;
use App\Services\GenerateToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminMobile extends Component
{

    public $name;
    public $mobile;


    public function mount()
    {
        $info = Auth::user();
        $this->name = $info->name;
        $this->mobile = $info->mobile;

    }

    protected function rules()
    {
        return [
            'mobile' => ['unique:users',Rule::unique('users')->ignore(Auth::id()), new MobileValidationRule()]
        ];
    }


    protected $messages =
        [
            'mobile.unique' => 'موبایل وارد شده تکراری است',
        ];

    public function editMobile()
    {
        $this->validate();
        $code = GenerateToken::generateToken();
        try {
            $admin = Auth::user();
            $admin->mobile = $this->mobile;
            $admin->code = $code;
            $admin->code_verified_at = null;
            $admin->remember_token = null;
            $admin->save();
            $admin->notify(new AdminAuthNotification($admin));
            session()->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد');
            return redirect()->to('/admin/validate/mobileForm');
        }catch (\Exception $ex){
            return view('errors_custom.model_store_error');
        }
    }


    public function render()
    {
        return view('livewire.admin.admin-mobile')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['admin' => Auth::user()]);
    }
}
