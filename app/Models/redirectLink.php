<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache; 

class redirectLink extends Model
{
     public $table = 'redirect';

     public static function boot()
     {
        parent::boot();

          static::updated(function ($instance) {

           
             // update cache content
             Cache::forget('checkLinkRedirect_'.$instance->request_path);

             Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
           
          });

          static::deleted(function ($instance) {
            // update cache content
           Cache::forget('checkLinkRedirect_'.$instance->request_path);

           Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
            
          });

          static::created(function ($instance) {
               // update cache content
               Cache::forget('checkLinkRedirect_'.$instance->request_path);

               Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
           
          });    
    }
}
