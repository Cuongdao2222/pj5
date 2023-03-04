<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class priceAutoPromotionActive extends Model
{
     public $table = 'price_auto_promotion_active';

     public static function boot()
     {
          parent::boot();

          static::updated(function ($instance) {

               Cache::forget('price_auto_promotion_active');
          
          });

        
     }
}
