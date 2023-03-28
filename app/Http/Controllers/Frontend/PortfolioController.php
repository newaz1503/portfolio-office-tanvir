<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\TypePortfolio;
use App\Models\Portfolio;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PortfolioController extends Controller
{
    public function portfolio_by_type($slug){
        $portfolio_type = TypePortfolio::where('slug', $slug)->first();
        $portfolios = Portfolio::where('typeportfolio_id', $portfolio_type->id)->get();
        return view('frontend.portfolio-by-type', compact('portfolios', 'portfolio_type'));
    }
    public function portfolio_by_category($slug){
        $categories = Category::where('status', 'active')->latest()->get();
        $category = Category::where('slug', $slug)->first();
        return view('frontend.portfolio-by-category', compact('category','categories'));
    }

}
