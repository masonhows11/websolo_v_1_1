<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory,HasPersianSlug;
    protected $table = 'articles';
    protected  $fillable = [
        'title_persian','title_english','slug','image','short_description','description','approved','user_id'
    ];
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_persian')
            ->saveSlugsTo('slug');
    }
    public function categories(){
        return
            $this->belongsToMany(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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
