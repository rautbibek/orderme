<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointValue extends Model
{
    const SCHEME_SELF_REGISTERED = 'self-registered';
    const SCHEME_REFERRAL = 'referral';
    const SCHEME_INDIRECT_REFERRAL = 'indirect-referral';
    const SCHEME_PURCHASE_DIRECT = 'purchase-direct';
    const SCHEME_PURCHASE_REFERRAL = 'purchase-referral';
    const SCHEME_REDEEM = 'redeem';
    use HasFactory;
}
