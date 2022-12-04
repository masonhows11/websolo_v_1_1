<?php

namespace App\Http\Livewire\Front;

use App\Models\Training;
use Livewire\Component;

class HomeTraining extends Component
{
    public function render()
    {
        return view('livewire.front.home-training')
            ->with(['trainings'=>Training::where('approved',1)->take(4)->get()]);
    }
}
