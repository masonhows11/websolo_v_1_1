<?php

namespace App\Http\Livewire\Front;

use App\Models\Training;
use Livewire\Component;

class Trainings extends Component
{
    public function render()
    {
        return view('livewire.front.trainings')
            ->extends('front.include.master')
            ->section('main_content')
            ->with(['trainings'=>Training::where('approved','1')->paginate(12)]);
    }
}
