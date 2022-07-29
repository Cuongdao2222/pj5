<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Support\Facades\Cache;

/**
 * Class product
 * @package App\Models
 * @version January 19, 2022, 4:54 am UTC
 *
 * @property string $Image
 * @property string $Product
 * @property string $ProductSku
 * @property string $Link
 * @property string $Detail
 * @property string $Salient_Features
 * @property string $Specifications
 * @property integer $Quantily
 * @property string $Maker
 * @property string $Group
 */
class product extends Model
{

    public $table = 'products';

    public static function boot()
    {
        parent::boot();

        static::updating(function ($instance) {
            // update cache content
            Cache::forget('data-detail'.$instance->slug);
            Cache::forever('data-detail'.$instance->Link,$instance);
           
        });

        static::deleting(function ($instance) {
            // delete post cache
            Cache::forget('data-detail'.$instance->Link);
        });
    }
    
    public $fillable = [
        'Image',
        'Name',
        'ProductSku',
        'Link',
        'Detail',
        'Salient_Features',
        'Specifications',
        'Quantily',
        'Maker',
        'Group_id',
        'Price',
        'Meta_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Image' => 'string',
        'Name' => 'string',
        'ProductSku' => 'string',
        'Link' => 'string',
        'Quantily' => 'integer',
        'Maker' => 'string',
        'Group_id' => 'string',
        'Price' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'Name' => 'required|unique:products|max:1000',
        'ProductSku' => 'required|unique:products',
       
        'Price' => 'required',
        
    ];

    public static $rule = [
        'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        // 'Name' => 'required|max:1000',
        // 'ProductSku' => 'required',
        // 'Specifications' => 'required',
        // 'Price' => 'required|integer',
        
    ];

    
}
