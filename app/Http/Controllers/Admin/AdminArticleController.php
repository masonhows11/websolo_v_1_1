<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\GetImageName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminArticleController extends Controller
{
    //
    public function index()
    {
        return view('dash.article.index');
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('dash.article.create')
            ->with(['categories'=>$categories,'tags'=>$tags]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title_persian' => 'required|min:3|max:30',
            'title_english' => 'required|min:3|max:30',
            'short_description' => 'required|min:10|max:500',
            'description' => 'required|min:10|max:5000',
            'image' => 'required',
            'category' => 'required',
            'tag' => 'required',
        ], $message = [
            'title_persian.required' => 'عنوان مقاله الزامی است.',
            'title_persian.min' => 'حداقل ۵ کاراکتر.',
            'title_persian.max' => 'حداکثر ۳۰ کاراکتر.',

            'title_english.required' => 'عنوان مقاله الزامی است.',
            'title_english.min' => 'حداقل ۵ کاراکتر.',
            'title_english.max' => 'حداکثر ۳۰ کاراکتر.',

            'short_description.required' => 'خلاصه الزامی است.',
            'short_description.min' => 'حداقل ۱۰ کاراکتر',
            'short_description.max' => 'حداکثر ۱۹۰ کاراکتر.',

            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'حداقل ۱۰ کاراکتر',
            'description.max' => 'حداکثر تعداد کاراکتر.',

            'image.required' => 'انخاب عکس الزامی است.',
            'category.required' => 'انتخاب دسته بندی الزامی است.',

            'tag.required' => 'انتخاب تگ الزامی است.',
        ]);


        try {
            $image = GetImageName::articleImage($request->image);
            DB::transaction(function () use ($image, $request) {
                $article = Article::create([
                    'title_persian' => $request->title_persian,
                    'title_english' => $request->title_english,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'image' => $image,
                    'user_id' => Auth::id(),
                ]);
                $article->categories()->sync($request->category);
                $article->tags()->sync($request->tag);

            });

            session()->flash('success', 'مقاله جدید با موفقیت ذخیره شد.');
            return redirect()->route('admin.article.index');

        } catch (\Exception $ex) {
          return view('errors_custom.model_store_error');
        }
    }

    public function edit(Article $article)
    {
        try {
            $tags = DB::table('tags')->get();
            $categories = DB::table('categories')->get();
            return view('dash.article.edit')
                ->with(['article' => $article,
                    'categories' => $categories,
                    'tags'=>$tags]);
        }catch (\Exception $ex){
            return  view('errors_custom.model_not_found');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_persian' => 'required|min:3|max:30',
            'title_english' => 'required|min:3|max:30',
            'short_description' => 'required|min:10|max:190',
            'description' => 'required|min:10|max:5000',
            'image' => 'required',
            'category' => 'required',
        ], $message = [
            'title_persian.required' => 'عنوان مقاله الزامی است.',
            'title_persian.min' => 'حداقل ۵ کاراکتر.',
            'title_persian.max' => 'حداکثر ۳۰ کاراکتر.',

            'title_english.required' => 'عنوان مقاله الزامی است.',
            'title_english.min' => 'حداقل ۵ کاراکتر.',
            'title_english.max' => 'حداکثر ۳۰ کاراکتر.',

            'short_description.required' => 'خلاصه الزامی است.',
            'short_description.min' => 'حداقل ۱۰ کاراکتر',
            'short_description.max' => 'حداکثر ۱۹۰ کاراکتر.',

            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'حداقل ۱۰ کاراکتر',
            'description.max' => 'حداکثر تعداد کاراکتر.',

            'image.required' => 'انخاب عکس الزامی است.',
            'category.required' => 'انتخاب دسته بندی الزامی است.',

        ]);
        try {
            $article = Article::findOrFail($request->id);
            $image = GetImageName::articleImage($request->image);
            DB::transaction(function () use ($article, $image, $request) {
                $article->title_persian = $request->title_persian;
                $article->title_english = $request->title_english;
                $article->short_description = $request->short_description;
                $article->description = $request->description;
                $article->image = $image;
                $article->user_id = Auth::id();
                $article->save();
                $article->categories()->sync($request->category);
                $article->tags()->sync($request->tag);
            });
            session()->flash('success', 'مقاله با موفقیت بروز رسانی شد.');
            return redirect()->route('admin.article.index');
        } catch (\Exception $ex) {
           return  view('errors_custom.model_store_error');
        }
    }


}
