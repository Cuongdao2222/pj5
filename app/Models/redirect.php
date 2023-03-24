<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class redirect extends Model
{
    public $table = 'redirect';

    parent::boot();

    static::created(function ($instance) {

       // update cache content
       Cache::forget('checkLinkRedirect_'.$instance->request_path);

       Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
       
    });

    static::updated(function ($instance) {
        
        // update cache content
        Cache::forget('checkLinkRedirect_'.$instance->request_path);

       Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
         
    });

    static::deleted(function ($instance) {
        Cache::forget('checkLinkRedirect_'.$instance->request_path);

        Cache::forever('checkLinkRedirect_'.$instance->request_path, $instance->target_path);
          
    });
}
