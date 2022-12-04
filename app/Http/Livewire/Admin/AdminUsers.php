<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $stateUser = true;

    public function activeUser($id)
    {
        $user = User::find($id);
        if ($user->banned == 0) {
            $user->banned = 1;
            $user->save();
            $this->stateUser = true;
        } else {
            $user->banned = 0;
            $user->save();
            $this->stateUser = false;
        }
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        session()->flash('success', 'کاربر مورد نظر با موفقیت حذف شد');
    }

    public function render()
    {
        return view('livewire.admin.admin-users')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['users' => User::paginate(5)]);
    }
}
