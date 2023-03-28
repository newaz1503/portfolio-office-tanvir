<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models\Base;

use App\Helpers\GlobalHelper;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BaseModel extends Model
{

    use LogsActivity;

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    //--------------------------------------------------------
    // ACTIVITY LOG INFO
    //--------------------------------------------------------
    protected static $logUnguarded = true;
    // Activity Log only changed column
    protected static $logOnlyDirty  = true;
    protected static $logAttributes = ['*'];
    public function getDescriptionForEvent(string $eventName): string
    {
        $guard = GlobalHelper::get_guard();
        $name  = Auth::guard($guard)->user()->name ?? "";
        return "{$name} - {$eventName} this";
    }
}
