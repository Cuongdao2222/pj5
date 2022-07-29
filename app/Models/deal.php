<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class deal extends Model
{
     public $table = 'deal';

     public static function boot()
     {
          parent::boot();

          static::creating(function ($instance) {
               // update cache content
               Cache::forget('deals');
               Cache::forever('deals',$instance);
          });

          static::updating(function ($instance) {
               // update cache content
               Cache::forget('deals');
               Cache::forever('deals',$instance);
               Cache::forget('deal_details'.$instance->product_id);
               Cache::forever('deal_details'.$instance->product_id,$instance);
          });

          static::deleting(function ($instance) {
               Cache::forget('deals');
               Cache::forever('deals',$instance);
               Cache::forget('deal_details'.$instance->product_id);
               Cache::forever('deal_details'.$instance->product_id,$instance);
          });
    }
}
