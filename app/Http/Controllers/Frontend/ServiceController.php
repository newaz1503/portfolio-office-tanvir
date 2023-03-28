<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PhotographyPrice;
use App\Models\Service;
use App\Models\ServiceDetails;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function service(){

        $service = Service::latest()->first();
        $service_prices = PhotographyPrice::where('status', 'active')->latest()->take(6)->get();
        $service_details = ServiceDetails::where('status', 'active')->latest()->take(4)->get();
        return view('frontend.service', compact('service', 'service_prices', 'service_details'));
    }
}
