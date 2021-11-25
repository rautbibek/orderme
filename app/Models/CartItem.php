<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function variant(){
        return $this->belongsTo('App\Models\Variant');
    }
}
