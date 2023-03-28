<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Website\Gallery\Slider;
use Illuminate\Support\Facades\App;

class HomeController extends Controller {
    /**======MENUS======**/
    public function menus() {
        return [
            "menus"  => App::make( 'frontMenuObj' ),
            "config" => App::make( 'siteSettingObj' ),
        ];
    }

    /**======WEBSITE HOME PAGE======**/
    public function homePage() {
        return App::make( 'websiteObj' );
    }

    public function home(){
        $sliders = Slider::latest()->take(5)->get();
        return view('frontend.home', compact('sliders'));
    }


}
