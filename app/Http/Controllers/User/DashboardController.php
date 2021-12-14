<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Theme;
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
        return response()->json(['reference' => $user->reference, 'point_value' => $user->point_value]);
    }
}
