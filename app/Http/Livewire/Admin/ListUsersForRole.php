<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsersForRole extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.list-users-for-role')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['users' => User::paginate(5)]);
    }
}
