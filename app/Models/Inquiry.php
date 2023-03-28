<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Inquiry extends BaseModel
{
    protected $table = 'inquiries';
    protected $guarded = [];

    protected static $logName = "Inquiry";
}
