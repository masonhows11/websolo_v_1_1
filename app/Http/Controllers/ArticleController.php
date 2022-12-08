<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;


class ArticleController extends Controller
{
    //

    public function index()
    {
        return view('front.article.articles')->with(['articles' => Article::where('approved', 1)->paginate(12), 'categories' => Category::tree()->get()->toTree()]);
    }

    public function article(Article $article)
    {
        if (View::where('article_id', $article->id)->where('user_id', Auth::id())->exists())
        {

        } else {
            View::create(['article_id' => $article->id, 'user_id' => Auth::id()]);
            $article->views++;
            $article->save();
        }
        return view('front.article.article')
            ->with(['article' => $article]);
    }

    public function articleCategory(Category $category)
    {
        return view('front.article.article_by_category')
            ->with(['articles' => $category->articles()->paginate(12), 'categories' => Category::tree()->get()->toTree()]);
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
           return  response()->json(['msg'=> $validator->errors(),'status'=>422],200);
       }

        if(!Article::find($request->id)){
            return response()->json(['msg' => 'مقاله مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Comment::create([
                'user_id' => Auth::id(),
                'article_id' => $request->id,
                'body' => $request->body,
            ]);
            return response()->json(['msg' => 'دیدگاه با موفقیت ثبت شد.', 'status' => 200], 200);
        }catch (\Exception $ex){
            return response()->json(['msg' => 'خطایی رخ داده.', 'status' => 500], 200);
        }


    }

    public function addLike(Request $request)
    {

        $article = Article::findOrFail($request->id);
        $auth_id = Auth::id();
        $is_like = $request['is_liked'] === 'true';
        try {
            $user_is_liked = Like::where('article_id', '=', $request->id)
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
                $newLike->article_id = $article->id;
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
