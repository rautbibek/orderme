<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function variants(){
        return $this->hasMany('App\Models\Variant');
    }

     public function getOptionsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getImageAttribute($value)
    {
        return json_decode($value, true);
    }

    public function productType(){
        return $this->belongsTo('App\Models\ProductType');
    }
    public function setProductTypeIDAttribute($value)
    {
        $productTYpe = ProductType::findOrFail($value);
        $this->attributes['product_type_id'] = $value;
        $this->attributes['cart_system'] = $productTYpe->cart_system;
    }
}
