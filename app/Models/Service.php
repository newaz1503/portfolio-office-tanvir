<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Service extends BaseModel
{
    protected $table = "services";
    protected $guarded = ["id"];

    protected static $logName = "Service";
}
