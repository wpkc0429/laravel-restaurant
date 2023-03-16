<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The database table of restaurants
     *
     * @var string
     */
    protected $table = 'restaurants';

    /**
     * The primary key of the database table
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
