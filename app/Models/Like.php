<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $guarded = [
        /*'user_id',
        'like',
        'article_id',
        'sample_id'*/
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function sample(){
        return $this->belongsTo(Sample::class);
    }
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
