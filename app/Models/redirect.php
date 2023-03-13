<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class redirect extends Model
{
    public $table = 'redirect';

    parent::boot();

    static::created(function ($instance) {
       // update cache content
       Cache::forget('checkLinkRedirect');
      
    });

    static::updated(function ($instance) {
        // update cache content
        Cache::forget('checkLinkRedirect');
         
    });

    static::deleted(function ($instance) {
        Cache::forget('checkLinkRedirect');
          
    });
}
