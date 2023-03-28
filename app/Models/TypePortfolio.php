<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Base\BaseModel;

class TypePortfolio extends BaseModel
{
    protected $table = "type_portfolios";
    protected $guarded = [];

    protected static $logName = "TypePortfolio";
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = TypePortfolio::createSlug($url->name);
        });
    }
    private static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = TypePortfolio::where(['slug' => $slug])->count();
        if ($count > 0) {
            $slug = $slug . $count;
        }
        return $slug;
    }

    public function portfolios(){
        return $this->hasMany(Portfolio::class, 'typeportfolio_id', 'id');
    }



}
