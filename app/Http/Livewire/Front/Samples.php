<?php

namespace App\Http\Livewire\Front;

use App\Models\Sample;
use Livewire\Component;
use Livewire\WithPagination;

class Samples extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.front.samples')
            ->extends('front.include.master')
            ->section('main_content')
            ->with(['samples'=>Sample::where('approved','1')->paginate(12)]);
    }
}
