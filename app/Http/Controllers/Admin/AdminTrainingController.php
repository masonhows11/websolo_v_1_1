<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Services\GetImageName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTrainingController extends Controller
{
    //
    public function index()
    {
        return view('dash.training.index');
    }

    public function create()
    {
        return view('dash.training.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_persian' => 'required|min:3|max:30',
            'title_english' => 'required|min:3|max:30',
            'short_description' => 'required|min:10|max:190',
            'description' => 'required|min:10',
            'image' => 'required',

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


            'image.required' => 'انخاب عکس الزامی است.',

        ]);

        try {
            $image = GetImageName::trainingImage($request->image);
            DB::transaction(function () use ($image, $request) {
                Training::create([
                    'title_persian' => $request->title_persian,
                    'title_english' => $request->title_english,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'image' => $image,
                    'user_id' => Auth::id(),
                ]);
            });
            session()->flash('success', 'آموزش جدید با موفقیت ذخیره شد.');
            return redirect()->route('admin.training.index');
        } catch (\Exception $ex) {
           return view('errors_custom.model_store_error');
        }
    }

    public function edit(Training $training)
    {
        try {
            return view('dash.training.edit')
                ->with(['training' => $training]);
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }

    }

    public function update(Request $request)
    {
        $request->validate([
            'title_persian' => 'required|min:3|max:30',
            'title_english' => 'required|min:3|max:30',
            'short_description' => 'required|min:10|max:190',
            'description' => 'required|min:10',
            'image' => 'required',

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

            'image.required' => 'انخاب عکس الزامی است.',

        ]);

        try {
            $training = Training::findOrFail($request->id);
            $image = GetImageName::trainingImage($request->image);
            DB::transaction(function () use ($training, $image, $request) {
                $training->title_persian = $request->title_persian;
                $training->title_english = $request->title_english;
                $training->short_description = $request->short_description;
                $training->description = $request->description;
                $training->image = $image;
                $training->user_id = Auth::id();
                $training->save();
            });
            session()->flash('success', 'آموزش با موفقیت بروز رسانی شد.');
            return redirect()->route('admin.training.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }
}
