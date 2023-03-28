<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models\Website\Gallery;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->slug = Album::createSlug($url->name);
        });
    }
    public static function createSlug($name)
    {
        $slug = Str::slug($name);
        $count = Album::where(['slug' => $slug])->count();
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
