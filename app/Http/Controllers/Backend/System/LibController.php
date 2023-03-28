<?php

namespace App\Http\Controllers\Backend\System;

use Auth;
use App\Models\Category;
use App\Models\TypePortfolio;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class LibController extends Controller
{
    private $variable = [];

    private function index()
    {
        return [
            'variable' => $this->variable
        ];
    }

    /**
     * SYSTEMS DATA RETURN
     */
    public function systems()
    {
        return [
            "global"        => $this->index(),
            "profile"       => Auth::guard('admin')->user()->profile ?? '',
            "permissions"   => App::make('premitedMenuArr'),
            "site"          => App::make('siteSettingObj'),
            "menus"         => App::make('sideMenus')
        ];
    }

    public function category()
    {
        $category = Category::select('id','name')->where('status','active')->get();
        return response()->json($category);
    }
    public function portfolio_types(){
        $portfolioType = TypePortfolio::select('id', 'name')->where('status', 'active')->get();
        return response()->json($portfolioType);
    }

    public function getStatistics()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        return [
            'total_user' => User::count(),
            'total_category' => Category::count(),
            'total_order' => Order::count(),
            'today_order' => Order::whereDate('created_at',$todayDate)->count(),
            'today_orders' => Order::with('portfolio', 'user')->whereDate('created_at',$todayDate)->get(),
            // 'total_user' => User::all(),
        ];
    }
}
