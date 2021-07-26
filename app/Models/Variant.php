<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'quantity', 'price', 'old_price'];

    public function product(){
      return  $this->belongsTo('App\Models\Product');
    }

      public function setFeaturesAttribute($value)
    {
      
        $this->attributes['features'] = json_encode($value);
    }
}
