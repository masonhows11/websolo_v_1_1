<?php


namespace App\Services;


use Illuminate\Support\Facades\App;

class GetImageName
{
    public static function articleImage($imagePath)
    {
        $path = 'http://websolo.test/storage/articles/';
        return $image = str_replace($path, '', $imagePath);
    }
    public static function trainingImage($imagePath)
    {
        $path = 'http://websolo.test/storage/training/';
        return $image = str_replace($path, '', $imagePath);
    }


    public static function sampleMainImage($imagePath)
    {
        $path = 'http://websolo.test/storage/samples/';
        return $image = str_replace($path, '', $imagePath);
    }

    public static function sampleMultiImage($images)
    {

        $img_array = array();
        $image_name_array = array();
        array_push($img_array,
            $images->input('image1'),
            $images->input('image2'),
            $images->input('image3'),
            $images->input('image4'));

        $array_count = count($img_array);
        for ($i = 0; $i < $array_count; $i++) {
            array_push($image_name_array, str_replace('http://websolo.test/storage/samples/', '', $img_array[$i]));
        }
        return $image_collection = collect($image_name_array);
    }


}
