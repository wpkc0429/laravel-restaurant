<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table of products
     *
     * @var string
     */
    protected $table = 'products';

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
        "restaurant_id",
        "name",
        "unit_price",
        "desc",
    ];

    /**
     * 取得店家
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
