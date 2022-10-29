<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class redirectLink extends Model
{
     public $table = 'redirect';

     public static function boot()
     {
        parent::boot();

          static::updated(function ($instance) {
           
            Cache::forget('link_redirect');
           
          });

          static::deleted(function ($instance) {
            Cache::forget('link_redirect');
            
          });

          static::created(function ($instance) {
            Cache::forget('link_redirect');
           
          });    
    }
}
