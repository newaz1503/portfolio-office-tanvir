<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models\System;

use App\Models\Base\BaseModel;

class SiteSetting extends BaseModel
{
    protected $guarded = ['id'];

    protected static $logName = 'Site Settings';

    public function getLogoAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;
    }
    public function getLogoSmallAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;
    }
    public function getFaviconAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;
    }

    public function getHeaderImageAttribute($value)
    {
        if (!empty($value)) {
            return url('/') . "/public/storage/" . $value;
        }
        return null;
    }
}
