<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    protected $fillable = ['product_name', 'product_description', 'product_SKU', 'product_price', 'product_quantity'];
    protected $guarded = ['product_id'];
}
