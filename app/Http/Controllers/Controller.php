<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Redirect Response
    public function responseReturn( $type, $model = null ) {

        if ( $type == "create" ) {
            $reType = $model ? "Successfully" : "Unsuccessfully";
            $key    = $model ? "message" : "error";

            return response()->json( [$key => "Create {$reType}!"], 200 );

        } elseif ( $type == "update" ) {
            if ( $model->wasChanged() ) {
                return response()->json( ['message' => "Update Successfully!"], 200 );
            }
            return response()->json( ['warning' => "No data updated"], 200 );

        } elseif ( $type == "delete" ) {
            $reType = $model ? "Successfully" : "Unsuccessfully";
            $key    = $model ? "message" : "error";
            return response()->json( [$key => "Delete {$reType}!"], 200 );
        }
    }
}
