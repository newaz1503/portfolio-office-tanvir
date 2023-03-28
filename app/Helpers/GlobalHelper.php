<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GlobalHelper extends Model
{
    public static function get_guard()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        } else if (Auth::guard('web')->check()) {
            return "user";
        } else {
            return null;
        }
    }
    public static  function envUpdate($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            $lines = explode("\n", file_get_contents($path));

            $settings = collect($lines)
                ->filter()
                ->transform(function ($item) {
                    return explode("=", $item, 2);
                })
                ->pluck(1, 0);

            $settings[$key] = $value;

            $rebuilt = $settings->map(function ($value, $key) {
                return "$key=$value";
            })->implode("\n");

            file_put_contents($path, $rebuilt);
        }
    }
}
