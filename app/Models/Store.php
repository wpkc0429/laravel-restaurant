<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Store extends Model
{
    /**
     * The database table of stores
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The primary key of the database table
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table's attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "phone",
        "business_time",
        "lat",
        "lng",
    ];

    /**
     * 更新快取
     */
    public static function boot()
    {
        parent::boot();
               
        self::created(function ($store) {
            if( Cache::has('stores') ){
                $stores = Cache::get('stores');
                $stores = $stores->put($store->id, $store->only(['id','name','phone','business_time','lat','lng']));
                Cache::forever('stores', $stores);
            }
        });

        self::updated(function ($store) {
            if( Cache::has('stores') ){
                $stores = Cache::get('stores');
                $stores[$store->id] = $store->only(['id','name','phone','business_time','lat','lng']);
                Cache::forever('stores', $stores);
            }
        });

        self::deleting(function ($store) {
            if( Cache::has('stores') ){
                $stores = Cache::get('stores');
                $stores->forget($store->id);
                Cache::forever('stores', $stores);
            }
        });
    }

    /**
     * return latlng_mask
     *
     * @return string $latlng_mask
     */
    public function getLatlngMaskAttribute()
    {
        return $this->lat.','.$this->lng;
    }

    /**
     * 取得餐點
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
