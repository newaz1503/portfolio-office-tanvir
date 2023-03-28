<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class PMenuController extends Controller {
    public function content() {
        return view( 'layouts.backend_app' );
    }
    public function galleryImages() {
        return view( 'layouts.backend_app' );
    }
}
