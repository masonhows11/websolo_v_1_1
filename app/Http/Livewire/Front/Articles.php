<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Articles extends Component
{
    public function render()
    {
        return view('livewire.front.articles')
            ->extends('front.include.master')
            ->section('main_content');
    }
}
