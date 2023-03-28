<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function gallery(){
        return view('frontend.gallery');
    }
    public function gallery_details($id){
        $portfolio = Portfolio::find($id);
        $portfolios = Portfolio::where('status', 'active')->latest()->get();
        return view('frontend.gallery_details', compact('portfolios', 'portfolio'));
    }
}
