<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use Livewire\Component;

class HomeArticles extends Component
{
    public function render()
    {
        return view('livewire.front.home-articles')
            ->with(['articles'=>Article::where('approved',1)->take(4)->get()]);
    }
}
