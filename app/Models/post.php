<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Support\Facades\Cache;

/**
 * Class post
 * @package App\Models
 * @version November 29, 2021, 1:14 pm UTC
 *
 * @property string $image
 * @property string $title
 * @property string $content
 */
class post extends Model
{

    public $table = 'posts';

    public static function boot()
    {
        parent::boot();

        static::updated(function ($instance) {
            
            Cache::forget('post_promotion');
            Cache::forget('post_home');
            Cache::forget('post_advice');
            Cache::forget('view-homes');
           
        });

        static::deleted(function ($instance) {
            
            Cache::forget('post_promotion');
            Cache::forget('post_home');
            Cache::forget('post_advice');
            Cache::forget('view-homes');

        });

        static::created(function ($instance) {

            Cache::forget('post_promotion');
            Cache::forget('post_home');
            Cache::forget('post_advice');
            Cache::forget('view-homes');

        });    
    }


    public $fillable = [
        'image',
        'title',
        'content',
        'link',
        'category',
        'id_user',
        'shortcontent',
        'Meta_id',
        'date_post',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'title' => 'string',
        'link'  => 'string',
        'category' => 'string',
        'shortcontent'=> 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|max:10000|mimes:jpg,jpeg,png',
        'title' =>  'required|max:4096|unique:posts',
        'content' =>  'required',
        'shortcontent'=> 'max:4096',

    ];
    
     public static $rulesUpdate = [
        'image' => 'max:10000|mimes:jpg,jpeg,png',
        'title' =>  'required|max:4096',
        'content' =>  'required',
        

    ];

    
}
