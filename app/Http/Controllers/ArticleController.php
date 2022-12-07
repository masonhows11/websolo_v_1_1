<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //

    public function index()
    {
        return view('front.article.articles')->with(['articles' => Article::where('approved', 1)->paginate(12), 'categories' => Category::tree()->get()->toTree()]);
    }

    public function article(Article $article)
    {

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

        return $request;
        /* $request->validate([
             'body' => 'required|min:6',
         ],$messages = [
             'body.required' => 'متن دیدگاه را وارد کنید.',
             'body.min' => 'حداقل ۶ کارکتر وارد کنید.',
         ]);*/

        /* $comment =
             Comment::create([
              'user_id' => Auth::id(),
              'article_id' => $request->id,
              'body' => $request->body,
          ]);*/
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->article_id = $request->id;
        $comment->body = $request->body;
        $comment->save();

        //   return $comment;
        return response()->json(['msg' => 'ok', 'status' => 200], 200);
        /* session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد.');*/
    }

    public function addLike(Request $request)
    {

        // return $request;
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
