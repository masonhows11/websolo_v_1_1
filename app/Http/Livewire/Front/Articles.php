<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;

class Articles extends Component
{
    public function render()
    {
        return view('livewire.front.articles')
            ->extends('front.include.master')
            ->section('main_content')
            ->with(['articles'=>Article::where('approved',1)->paginate(12),
                'categories'=>Category::tree()->get()->toTree()]);;
    }
}
