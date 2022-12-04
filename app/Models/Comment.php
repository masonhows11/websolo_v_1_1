<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected  $fillable =
        [
            'user_id',
            'article_id',
            'sample_id',
            'body',
        ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
    public function training(){

        return $this->belongsTo(Training::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
