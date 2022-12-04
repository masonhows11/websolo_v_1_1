<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontEnd extends Model
{
    use HasFactory;
    protected $table = 'front_ends';
    protected $fillable = ['title_persian','title_english'];
    public function samples()
    {
        return $this->belongsToMany(Sample::class);
    }
}
