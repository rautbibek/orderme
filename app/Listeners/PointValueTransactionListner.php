<?php

namespace App\Listeners;

use App\Models\PointValue;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PointValueTransactionListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $user = $event->user;
        $refUser = null;
        if(!!$event->reference ){
            $refUser = User::where('reference', $event->reference)->first();
        }

        $pointValue = new PointValue();
        $pointValue->user_id = $user->id;
        if($event->scheme === PointValue::SCHEME_SELF_REGISTERED){
            if(!!$refUser){
                $user->reference_id = $refUser->id;
                $user->point_value = 35;
                $refUser->point_value += 10;
                $refUser->save();
                $user->save();
                $pointValue->point_value = 35;
                $pointValue->scheme = PointValue::SCHEME_REFERRAL;
                $pointValueForReferal = new PointValue();
                $pointValueForReferal->point_value = 10;
                $pointValueForReferal->user_id = $refUser->id;
                $pointValueForReferal->scheme = PointValue::SCHEME_INDIRECT_REFERRAL;
                $pointValueForReferal->save();

            }else{
                $user->point_value = 25;
                $user->save();
                $pointValue->point_value = 25;
                $pointValue->scheme = PointValue::SCHEME_SELF_REGISTERED;
            }
            session()->forget('reference');
            $pointValue->save();
        }

        if($event->scheme === PointValue::SCHEME_PURCHASE_DIRECT){

           // Adding 1 % of total amount to point value to direct purchase

            $user->point_value = $user->point_value + $event->orderTotal / 10000;
            $user->save();
            $pointValue->point_value = $user->point_value;
            $pointValue->scheme = PointValue::SCHEME_PURCHASE_DIRECT;
            $pointValue->save();

            // Adding 0.5% of total amount to point value to referal for indirect purchase
            $refUser = null;
            if(!!$user->reference_id){
                $refUser = User::where('id', $user->reference_id)->first();
            }

            if(!!$refUser){
                $refUser->point_value = $refUser->point_value + $event->orderTotal /20000;
                $refUser->save();
                $pointValue = new PointValue();
                $pointValue->user_id = $user->id;
                $pointValue->point_value = $refUser->point_value;
                $pointValue->scheme = PointValue::SCHEME_PURCHASE_REFERRAL;
                $pointValue->save();
            }
        }

    }
}
