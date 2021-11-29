<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function cartItems(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function customerAddress(){
        return $this->belongsTo('App\Models\CustomerAddress');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
