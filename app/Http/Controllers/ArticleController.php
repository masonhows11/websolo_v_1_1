<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;

class ArticleController extends Controller
{
    //

    public function index()
    {
        return view('front.article.articles')->with(['articles'=>Article::where('approved',1)->paginate(12),'categories'=>Category::tree()->get()->toTree()]);
    }

    public function articleCategory(Category $category)
    {
        return view('front.article.article_by_category')
            ->with(['articles'=>$category->articles()->paginate(12),'categories'=>Category::tree()->get()->toTree()]);
    }
}
