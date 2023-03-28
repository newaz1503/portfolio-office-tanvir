<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $search = $request->search;
        $category = Category::where('name','LIKE',"%$search%")->first();
        $portfolios = $category->portfolios()->latest()->get();
        return view('frontend.search', compact('category', 'portfolios'));
    }

}
