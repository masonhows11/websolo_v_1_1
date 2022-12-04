<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory,HasPersianSlug,HasRecursiveRelationships;

    protected $table = 'categories';
    protected $fillable = ['title_english','title_persian','slug','parent_id'];
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_persian')
            ->saveSlugsTo('slug');
    }
    public function child()
    {
        return $this->HasMany(Category::class,'parent_id');
    }
    public function getParentKeyName()
    {
        return 'parent_id';
    }
    public static function getParent($parent_id)
    {
        return  self::where('id',$parent_id)->first();
    }
    public function articles(){
        return
            $this->belongsToMany(Article::class);
    }
}
