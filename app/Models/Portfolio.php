<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Category;
use App\Models\Base\BaseModel;
use App\Models\TypePortfolio;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Portfolio extends BaseModel implements HasMedia
{
    use InteractsWithMedia ,InteractsWithMedia;

    protected $table = 'portfolios';
    protected $guarded = [];

    protected static $logName = "Portfolio";

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function portfolioTypes(){
        return $this->belongsTo(TypePortfolio::class, 'typeportfolio_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/uploads/portfolio/watermark/" . $value;
        }
        return null;
    }



}
