<?php

namespace App\Http\Livewire\Admin;

use App\Models\Training;
use Livewire\Component;

class AdminTrainingComment extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-training-comment')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['trainings'=>Training::paginate(10)]);
    }
}
