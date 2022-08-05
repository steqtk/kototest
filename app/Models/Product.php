<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'price_purchase', 'price_selling', 'price_discount', 'region_id'
    ];

}
