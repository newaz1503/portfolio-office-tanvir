<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){
        $about = About::latest()->first();
        return view('frontend.about', compact('about'));
    }
}
