<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Training;
use App\Models\view;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrontTraining extends Component
{
    public $training;
    public $is_like;
    public $like_count;
    public $body;
    public $like_color;
    public $current_like_status;
    public $auth_id;

    public function mount(Training $training)
    {

        if (View::where('training_id', $training->id)->where('user_id', Auth::id())->exists()) {
        } else {
            View::create(['training_id' => $training->id, 'user_id' => Auth::id()]);
            $training->views++;
            $training->save();
        }

        $this->auth_id = Auth::id();
        $this->training = $training;
        $this->like_count = Like::where('training_id', $this->training->id)->count();
        $this->current_like_status = Like::where('training_id', '=', $training->id)
            ->where('user_id', '=', $this->auth_id)
            ->exists();
        $this->like_color = 'color:tomato';
    }

    public function addLike($id)
    {
        if (Auth::check()) {
            $this->is_like = true;
            $user_is_liked = Like::where('training_id', '=', $id)
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
                $newLike->training_id = $this->training->id;
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
            'article_id' => $this->training->id,
            'body' => $this->body,
        ]);
        $this->body = null;
        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد.');
    }
    public function render()
    {
        return view('livewire.front.front-training')
            ->extends('front.include.master')
            ->section('main_content')
            ->with(['training' => $this->training]);
    }
}
