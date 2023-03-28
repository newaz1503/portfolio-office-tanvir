<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class ServiceDetails extends BaseModel
{
    protected $table = "service_details";
    protected $guarded = [];

    protected static $logName = "serviceDetails";
}
