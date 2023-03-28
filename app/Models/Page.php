<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Website\News;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    protected $guarded = ['id'];

    protected static $logName = "Page";


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = Page::createSlug($url->title);
        });
    }
    private static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Page::where(['slug' => $slug])->count();
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
}
