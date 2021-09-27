<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Yaml;

class ThemeController extends Controller
{
    public function index(){
        $themes = Theme::all();
        return response()->json($themes, 200);
    }

    public function store(Request $request){

        $theme = new Theme();
//        $theme->name = $request->name;
//        $theme->active = $request->active;
//        $theme->slug = Str::slug($request->name);
//        if(!file_exists(base_path()."/themes/frontend/views/themes/$theme->slug/config.yaml")){
//            return response()->json(['message' => 'No theme found of this name'], 400);
//        }
//        $theme->save();

        return response()->json($theme, 201);
    }

    public function edit(Request $request, $id){
        $theme = Theme::findOrFail($id);
        return response()->json($theme, 200);
    }

    public function update(Request $request, $id){
        $theme = Theme::findOrFail($id);
//        $theme->name = $request->name;
//        $theme->active = $request->active;
//        $theme->slug = Str::slug($request->name);
//        if(!file_exists(base_path()."/themes/frontend/views/themes/$theme->slug/config.yaml")){
//            return response()->json(['message' => 'No theme found of this name'], 400);
//        }
//        $theme->update();
        return response()->json($theme, 200);
    }

    public function configSetting(Request $request, $id){
        $theme = Theme::findOrFail($id);
        if ( $request->isMethod('put')) {
            $theme->config = json_encode($request->all());
            $theme->update();
            return response()->json([], 200);       }
        $config = Yaml::parse(file_get_contents(base_path()."/themes/frontend/views/themes/$theme->slug/config.yaml"));
        return response()->json(['theme' => $theme, 'config' => $config], 200);
    }

}
