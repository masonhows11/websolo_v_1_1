<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackEnd extends Model
{
    use HasFactory;
    protected $table ='back_ends';
    protected $fillable = ['title_persian','title_english'];
    public function samples()
    {
        return $this->belongsToMany(Sample::class);
    }
}
