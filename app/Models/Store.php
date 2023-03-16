<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
