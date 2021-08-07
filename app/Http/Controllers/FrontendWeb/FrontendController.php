<?php

namespace App\Http\Controllers\FrontendWeb;
use App\Models\Category;
use App\Models\Theme;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;

class FrontendController extends Controller
{
    public function homeIndex(){
        $theme = Theme::find(['active' => true])->first();
        if(!$theme){
            return view("themes.molla.template.welcome");

        }
        return view("themes.$theme->slug.template.welcome");
    }
}
