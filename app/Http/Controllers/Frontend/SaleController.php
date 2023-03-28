<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;

class SaleController extends Controller
{
    public function sale(){
        $categories = Category::where('status', 'active')->latest()->get();
        $portfolios = Portfolio::where('status', 'active')->latest()->get();
        return view('frontend.sale', compact('categories', 'portfolios'));
    }
}
