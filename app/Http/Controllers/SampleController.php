<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Sample;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    //
    public function sample(Sample $sample)
    {
        return view('front.sample.sample')
            ->with(['sample'=>$sample]);
    }
    public function addComment(Request $request)
    {
        $request->validate([
            'body' => 'required|min:6',
        ],$messages = [
            'body.required' => 'متن دیدگاه را وارد کنید.',
            'body.min' => 'حداقل ۶ کارکتر وارد کنید.',
        ]);
        Comment::create([
            'user_id' => $this->auth_id,
            'article_id' => $this->training->id,
            'body' => $this->body,
        ]);
        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد.');
    }

    public function addLike(Request $request)
    {


        /*$is_like = null;
        $like_count = null;
        $current_like_status = null;
        $auth_id = null;

        if (Auth::check()) {
            $is_like = true;
            $user_is_liked = Like::where('training_id', '=', $request->id)
                ->where('user_id', '=', $this->auth_id)
                ->first();
            if ($user_is_liked) {
                $user_is_liked->delete();
                $like_count--;
                $current_like_status = false;
                $like_color = null;
            } else {
                $newLike = new Like();
                $newLike->user_id = $auth_id;
                $newLike->training_id = $training->id;
                $newLike->like = $is_like;
                $newLike->save();
                $this->like_count++;
                $this->current_like_status = true;
                $this->like_color = 'color:tomato';
            }
        } else {
            return redirect('/login/form');
        }*/
    }
}
