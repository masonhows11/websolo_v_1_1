<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Sample extends Model
{
    use HasFactory, HasPersianSlug;
    protected $table = 'samples';
    protected $fillable =
        ['title_persian',
            'title_english',
            'back_ends',
            'front_ends',
            'short_description',
            'description',
            'main_image', 'image1', 'image2', 'image3', 'image4', 'user_id'];



    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_persian')
            ->saveSlugsTo('slug');
    }

    public function backEnds(){

        return $this->belongsToMany(BackEnd::class);
    }

    public function frontEnds()
    {
        return $this->belongsToMany(FrontEnd::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
