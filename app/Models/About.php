<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class About extends BaseModel
{
    protected $table = 'abouts';
    protected $guarded = ['id'];

    protected static $logName = "About";
}
