<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function dashboard(){
        $theme = Theme::find(['active' => true])->first();
        $user = auth()->user();
        // $orders = Order::where('user_id',$user->id)->paginate(10);
        $user_orders = Order::where('user_id', $user->id)->with('user', 'customerAddress', 'cartItems.variant.product')->paginate(5)->fragment('tab-orders');
        $shipping_address = CustomerAddress::where('user_id', Auth::id())->get();
        return view("themes.$theme->slug.template.index",compact('user','user_orders','shipping_address'));
    }

    public function getReference(){
        $user = Auth::user();
        if(!$user->reference){
            $user->reference =  Str::random(8);
            $user->save();
        }
        return response()->json(['reference' => $user->reference, 'point_value' => $user->point_value]);
    }
}
