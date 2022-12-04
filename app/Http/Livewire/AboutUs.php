<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.about-us')
            ->extends('front.include.master')
            ->section('main_content');
    }
}
