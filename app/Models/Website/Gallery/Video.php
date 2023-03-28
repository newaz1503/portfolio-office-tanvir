<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models\Website\Gallery;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = ['id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
