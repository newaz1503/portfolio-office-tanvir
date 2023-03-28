<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;

class Cart extends BaseModel
{
    protected $table = 'carts';
    protected $guarded = [];

    protected static $logName = "Cart";

    public function portfilio(){
        return $this->belongsTo(Portfolio::class, 'portfolio_id', 'id');
    }
}
