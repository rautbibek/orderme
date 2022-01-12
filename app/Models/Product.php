<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    const CONDITION_NEW = 'new';
    const CONDITION_OLD = 'old';
    const CONDITION_REFURBISH = 'refurbish';

    protected $appends = ['collections'];

    public function variants(){
        return $this->hasMany('App\Models\Variant');
    }

    public function setTitleAttribute($value) {

        if (static::whereSlug($slug = Str::slug($value))->exists()) {

            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

        $original = $slug;

        $count = 2;

        while (static::whereSlug($slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

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
        return $this->belongsTo('App\Models\ProductType', 'id');
    }
    public function setProductTypeIDAttribute($value)
    {
        $productTYpe = ProductType::findOrFail($value);
        $this->attributes['product_type_id'] = $value;
        $this->attributes['cart_system'] = $productTYpe->cart_system;
    }

    public function collections(){
        return $this->belongsToMany(Collection::class);
    }

    public function getCollectionsAttribute(){
        $collections = $this->collections();
        return $collections->pluck('collections.id')->toArray();
    }

}
