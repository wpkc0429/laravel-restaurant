<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Food extends Model
{
    /**
     * The database table of foods
     *
     * @var string
     */
    protected $table = 'foods';

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
        "store_id",
        "name",
        "unit_price",
        "desc",
    ];

    /**
     * 更新快取
     */
    public static function boot()
    {
        parent::boot();
               
        self::created(function ($food) {
            $store_id = $food->store_id;
            if( Cache::has('store_'.$store_id.'_foods') ){
                $foods = Cache::get('store_'.$store_id.'_foods');
                $foods = $foods->put($food->id, $food->only(['id','store_id','name','unit_price','desc']));
                Cache::forever('store_'.$store_id.'_foods', $foods);
            }
        });

        self::updated(function ($food) {
            $store_id = $food->store_id;
            if( Cache::has('store_'.$store_id.'_foods') ){
                $foods = Cache::get('store_'.$store_id.'_foods');
                $foods[$food->id] = $food->only(['id','store_id','name','unit_price','desc']);
                Cache::forever('store_'.$store_id.'_foods', $foods);
            }
            if( Cache::has('store_'.$store_id.'_food_'.$food->id) ){
                $cached_food = $food->only(['id','store_id','name','unit_price','desc']);
                Cache::forever('store_'.$store_id.'_food_'.$food->id, $cached_food);
            }
        });

        self::deleting(function ($food) {
            $store_id = $food->store_id;
            if( Cache::has('store_'.$store_id.'_foods') ){
                $foods = Cache::get('store_'.$store_id.'_foods');
                $foods->forget($food->id);
                Cache::forever('store_'.$store_id.'_foods', $foods);
            }
            if( Cache::has('store_'.$store_id.'_food_'.$food->id) ){
                Cache::forget('store_'.$store_id.'_food_'.$food->id);
            }
        });
    }

    /**
     * 取得店家
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
