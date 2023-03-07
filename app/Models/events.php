<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class events extends Model
{
    public $table = 'event';

    public static function boot()
    {
        parent::boot();
       
        static::updated(function ($instance) {
            // update cache content
            Cache::forget('events-show');
           
        });
         
    }
}
