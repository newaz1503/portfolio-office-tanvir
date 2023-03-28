<?php

namespace App\Providers;


use App\Models\Cart;
use App\Models\Portfolio;
use App\Models\System\SiteSetting;
use App\Models\TypePortfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $site_setting = SiteSetting::first();
        $portfolio_type = TypePortfolio::where('status', 'active')->get();
        View::share([
            'portfolio_types' => $portfolio_type,
            'site_setting' => $site_setting,
        ]);
        Schema::defaultStringLength( 191 );
    }
}
