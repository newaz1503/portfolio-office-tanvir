<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class PhotographyPrice extends BaseModel
{
    protected $table = "photography_prices";
    protected $guarded = ['id'];

    protected static $logName = "PhotographyPrice";
}
