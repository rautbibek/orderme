<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $theme = Theme::find(['active' => true])->first();
        return view("themes.$theme->slug.template.index");
    }
}
