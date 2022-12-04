<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Services\GetImageName;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminSampleController extends Controller
{
    //
    public function index()
    {
        return view('dash.sample.index');
    }

    public function create()
    {
        $back_ends = DB::table('back_ends')
            ->select(['id', 'title_persian'])
            ->get();
        $front_ends = DB::table('front_ends')
            ->select(['id', 'title_persian'])
            ->get();
        return view('dash.sample.create')
            ->with(['back_ends' => $back_ends, 'front_ends' => $front_ends]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_persian' => ['required', 'min:3', 'max:40'],
            'title_english' => ['required', 'min:3', 'max:40'],
            'back_ends' => ['required'],
            'front_ends' => ['required'],
            'description' => ['required', 'min:3', 'max:5000'],
            'short_description' => ['required', 'min:3', 'max:500'],
            'main_image' => ['required'],
            'image1' => ['required'],
            'image2' => ['required'],
            'image3' => ['required'],
            'image4' => ['required']
        ], $messages = [
            'title_persian.required' => 'عنوان مقاله الزامی است.',
            'title_persian.min' => 'حداقل ۳ کاراکتر.',
            'title_persian.max' => 'حداکثر ۴۰ کاراکتر.',

            'title_english.required' => 'عنوان مقاله الزامی است.',
            'title_english.min' => 'حداقل ۳ کاراکتر.',
            'title_english.max' => 'حداکثر ۴۰ کاراکتر.',

            'back_ends.required' => 'زبان یا فریم ورک سمت سرور الرامی است.',
            'front_ends.required' => 'زبان یا فریم ورک سمت کاربر الرامی است.',

            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'حداقل ۱۰ کاراکتر',
            'description.max' => 'حداکثر تعداد کاراکتر.',

            'short_description.required' => 'خلاصه الزامی است.',
            'short_description.min' => 'حداقل ۱۰ کاراکتر',
            'short_description.max' => 'حداکثر ۱۹۰ کاراکتر.',

            'main_image.required' => 'تصویر اصلی الزامی است.',

            'image1.required' => 'تصویر  شماره یک الزامی است.',
            'image2.required' => 'تصویر شماره دو الزامی است.',
            'image3.required' => 'تصویر  شماره سه الزامی است.',
            'image4.required' => 'تصویر  شماره چهار الزامی است.',

        ]);
        try {
            $image_samples = GetImageName::sampleMultiImage($request);
            $main_image = GetImageName::sampleMainImage($request->main_image);

            DB::transaction(function () use ($image_samples, $main_image, $request) {
                $sample =  Sample::create([
                    'title_persian' => $request->title_persian,
                    'title_english' => $request->title_english,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'user_id' => Auth::id(),
                    'main_image' => $main_image,
                    'image1' => $image_samples[0],
                    'image2' => $image_samples[1],
                    'image3' => $image_samples[2],
                    'image4' => $image_samples[3],
                ]);

                $sample->backEnds()->sync($request->back_ends);
                $sample->frontEnds()->sync($request->front_ends);
            });

            session()->flash('success', 'نمونه کار جدید با موفقیت ایجاد شد.');
            return redirect()->route('admin.sample.index');
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }
    public function edit($id)
    {
        $sample = Sample::findOrFail($id);
        $back_ends = DB::table('back_ends')
            ->select(['id', 'title_persian'])
            ->get();
        $front_ends = DB::table('front_ends')
            ->select(['id', 'title_persian'])
            ->get();
        return view('dash.sample.edit')
            ->with(['sample' => $sample, 'back_ends' => $back_ends, 'front_ends' => $front_ends]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_persian' =>
                ['required',Rule::unique('samples')->ignore($request->id), 'min:3', 'max:40'],
            'title_english' =>
                ['required',Rule::unique('samples')->ignore($request->id), 'min:3', 'max:40'],
            'back_ends' => ['required'],
            'front_ends' => ['required'],
            'description' => ['required', 'min:3', 'max:5000'],
            'short_description' => ['required', 'min:3', 'max:500'],
            'main_image' => ['required'],
            'image1' => ['required'],
            'image2' => ['required'],
            'image3' => ['required'],
            'image4' => ['required']
        ], $messages = [
            'title_persian.required' => 'عنوان مقاله الزامی است.',
            'title_persian.min' => 'حداقل ۳ کاراکتر.',
            'title_persian.max' => 'حداکثر ۴۰ کاراکتر.',

            'title_english.required' => 'عنوان مقاله الزامی است.',
            'title_english.min' => 'حداقل ۳ کاراکتر.',
            'title_english.max' => 'حداکثر ۴۰ کاراکتر.',

            'back_ends.required' => 'زبان یا فریم ورک سمت سرور الرامی است.',
            'front_ends.required' => 'زبان یا فریم ورک سمت کاربر الرامی است.',

            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'حداقل ۱۰ کاراکتر',
            'description.max' => 'حداکثر تعداد کاراکتر.',

            'short_description.required' => 'توضیحات الزامی است.',
            'short_description.min' => 'حداقل ۱۰ کاراکتر',
            'short_description.max' => 'حداکثر ۵۰۰ کاراکتر.',

            'main_image.required' => 'تصویر اصلی الزامی است.',

            'image1.required' => 'تصویر نمونه شماره یک الزامی است.',
            'image2.required' => 'تصویر نمونه شماره دو الزامی است.',
            'image3.required' => 'تصویر نمونه شماره سه الزامی است.',
            'image4.required' => 'تصویر نمونه شماره چهار الزامی است.',

        ]);

        try {

            $image_samples = GetImageName::sampleMultiImage($request);
            $main_image = GetImageName::sampleMainImage($request->main_image);

            DB::transaction(function () use ($request,$main_image,$image_samples) {

                $sample = Sample::findOrFail($request->id);
                $sample->title_persian = $request->title_persian;
                $sample->title_english = $request->title_english;
                $sample->short_description = $request->short_description;
                $sample->description = $request->description;
                $sample->user_id = Auth::id();
                $sample->main_image = $main_image;
                $sample->image1 = $image_samples[0];
                $sample->image2 = $image_samples[1];
                $sample->image3 = $image_samples[2];
                $sample->image4 = $image_samples[3];
                $sample->save();

                $sample->backEnds()->sync($request->back_ends);
                $sample->frontEnds()->sync($request->front_ends);

            });
            session()->flash('success', 'نمونه کار با موفقیت بروز رسانی شد.');
           // return redirect()->route('admin.sample.index');
            return redirect('/admin/sample/index')
                ->with(['success'=>'نمونه کار با موفقیت بروز رسانی شد.']);
        } catch (\Exception $ex) {
            // return  $ex->getMessage();
            return view('errors_custom.model_store_error');
        }
    }
}
