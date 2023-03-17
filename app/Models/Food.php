<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * 取得店家
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
