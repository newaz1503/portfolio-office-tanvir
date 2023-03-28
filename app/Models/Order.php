<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    protected static $logName = "Order";

    public function portfolio(){
        return $this->belongsTo(Portfolio::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
