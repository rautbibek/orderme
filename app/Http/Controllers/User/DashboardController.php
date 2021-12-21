<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function dashboard(){
        $theme = Theme::find(['active' => true])->first();
        return view("themes.$theme->slug.template.index");
    }

    public function getReference(){
        $user = Auth::user();
        if(!$user->reference){
            $user->reference =  Str::random(8);
            $user->save();
        }

        $referedUser = User::where('reference_id', $user->id)->get();
        $member = $referedUser->count();
        return response()->json(['reference' => $user->reference, 'point_value' => $user->point_value, 'member' => $member]);
    }

    public function getOrders(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('id','desc')->get();
        return response()->json($orders);
    }
}
