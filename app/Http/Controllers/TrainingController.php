<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //
    public function training(Training $training)
    {
        return view('front.training.single_training');
    }
}
