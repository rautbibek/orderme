<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $orders = Order::where('user_id', $user->id)->where('checkout_state', 'completed')->orderBy('id','desc')->get();
        return response()->json($orders);
    }

    public function getProfile(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'phone' => 'required|min:10',
                'password' => 'required',
                'confirm_password' => 'required'
            ]);


            if(Hash::check($request->password, $user->password) && $request->password === $request->confirm_password){

                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone;
                $user->config = ['image' => $request->image];
                $user->save();
            }else{
                abort(403, 'Unauthorized action.');
            }
        }
        return response()->json($user);
    }
}
