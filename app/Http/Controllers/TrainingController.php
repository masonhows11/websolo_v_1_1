<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Training;
use App\Models\view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class TrainingController extends Controller
{
    //

    public function training(Training $training)
    {
        /* if (View::where('training_id', $training->id)->where('user_id', Auth::id())->exists()) {
         } else {
             View::create(['training_id' => $training->id, 'user_id' => Auth::id()]);
             $training->views++;
             $training->save();
         }*/
        return view('front.training.training')->with(['training' => $training]);
    }

    public function addComment(Request $request)
    {

        //return $request;
        $validator = Validator::make($request->all(),[
            'body' => 'required|min:6',
        ], $messages = [
            'body.required' => 'متن دیدگاه را وارد کنید.',
            'body.min' => 'حداقل ۶ کارکتر وارد کنید.',
        ]);
        if($validator->fails()){
            return  response()
                ->json(['msg'=> $validator->errors(),'status'=>422],200);
        }

        if(!Training::find($request->id)){
            return response()
                ->json(['msg' => 'مقاله مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Comment::create([
                'user_id' => Auth::id(),
                'training_id' => $request->id,
                'body' => $request->body,
            ]);
            return response()->json(['msg' => 'دیدگاه با موفقیت ثبت شد.', 'status' => 200], 200);
        }catch (\Exception $ex){
            return response()->json(['msg' => 'خطایی رخ داده.', 'status' => 500], 200);
        }


    }

    public function addLike(Request $request)
    {

        $article = Training::findOrFail($request->id);
        $auth_id = Auth::id();
        $is_like = $request['is_liked'] === 'true';
        try {
            $user_is_liked = Like::where('training_id', '=', $request->id)
                ->where('user_id', '=', $auth_id)
                ->first();
            if ($user_is_liked) {
                $user_is_liked->delete();
                $like_count = DB::table('likes')->count();
                return response()->json([
                    'liked' => 'disliked',
                    'count' => $like_count,
                    'status' => 200],
                    200);
            } else {
                $newLike = new Like();
                $newLike->user_id = $auth_id;
                $newLike->training_id = $article->id;
                $newLike->like = $is_like;
                $newLike->save();
                $like_count = DB::table('likes')->count();
                return response()->json([
                    'liked' => 'liked',
                    'count' => $like_count,
                    'status' => 200],
                    200);
            }
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage(), 'status' => 500], 200);
        }


    }
}
