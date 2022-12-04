<?php

namespace App\Http\Livewire\Front;

use App\Models\Sample;
use Livewire\Component;

class HomeSamples extends Component
{
    public function render()
    {
        return view('livewire.front.home-samples')
            ->with(['samples'=>Sample::where('approved',1)->take(4)->get()]);
    }
}
