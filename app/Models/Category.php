<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Support\Str;
class Category extends BaseModel
{
    protected $table = 'categories';
    protected $guarded = [];

    protected static $logName = "Category";


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = Category::createSlug($url->name);
        });
    }
    private static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Category::where(['slug' => $slug])->count();
        if ($count > 0) {
            $slug = $slug . $count;
        }
        return $slug;
    }

    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;

    }
    public function portfolios(){
        return $this->hasMany(Portfolio::class, 'category_id', 'id');
    }
}
