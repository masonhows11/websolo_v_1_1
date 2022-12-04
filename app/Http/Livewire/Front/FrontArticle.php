<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\view;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrontArticle extends Component
{
    public $article;
    public $is_like;
    public $like_count;
    public $body;
    public $like_color;
    public $current_like_status;
    public $auth_id;

    public function mount(Article $article)
    {
        if (View::where('article_id', $article->id)->where('user_id', Auth::id())->exists()) {
        } else {
            View::create(['article_id' => $article->id, 'user_id' => Auth::id()]);
            $article->views++;
            $article->save();
        }

        $this->auth_id = Auth::id();
        $this->article = $article;
        $this->like_count = Like::where('article_id', $this->article->id)->count();
        $this->current_like_status = Like::where('article_id', '=', $article->id)
            ->where('user_id', '=', $this->auth_id)
            ->exists();
        $this->like_color = 'color:tomato';
    }

    public function addLike($id)
    {
        if (Auth::check()) {
            $this->is_like = true;
            $user_is_liked = Like::where('article_id', '=', $id)
                ->where('user_id', '=', $this->auth_id)
                ->first();
            if ($user_is_liked) {
                $user_is_liked->delete();
                $this->like_count--;
                $this->current_like_status = false;
                $this->like_color = null;
            } else {
                $newLike = new Like();
                $newLike->user_id = $this->auth_id;
                $newLike->article_id = $this->article->id;
                $newLike->like = $this->is_like;
                $newLike->save();
                $this->like_count++;
                $this->current_like_status = true;
                $this->like_color = 'color:tomato';
            }
        } else {
            return redirect('/login/form');
        }

    }

    protected $rules = [
        'body' => 'required|min:6',
    ];
    protected $messages = [
        'body.required' => 'متن دیدگاه را وارد کنید.',
        'body.min' => 'حداقل ۶ کارکتر وارد کنید.',
    ];

    public function submit()
    {
        $this->validate();
        Comment::create([
            'user_id' => $this->auth_id,
            'article_id' => $this->article->id,
            'body' => $this->body,
        ]);
        $this->body = null;
        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد.');
    }

    public function render()
    {
        return view('livewire.front.front-article')
            ->extends('front.include.master')
            ->section('main_content')
            ->with(['article' => $this->article]);
    }
}
