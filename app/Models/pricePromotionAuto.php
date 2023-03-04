<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;


class pricePromotionAuto extends Model
{
     public $table = 'price_promotion_auto';

     public static function boot()
     {
          parent::boot();

          static::updated(function ($instance) {

               Cache::forget('price_auto_promotion');
          
          });

          static::deleted(function ($instance) {

               Cache::forget('price_auto_promotion');
          });

          static::created(function ($instance) {
            
             Cache::forget('price_auto_promotion');
          });    

     }
}
