<?php

function getConfig(string $key){
    $theme = \App\Models\Theme::where('active', true)
        ->first();
    if(!$theme){
        $theme = \App\Models\Theme::where('slug', 'molla')
            ->first();
    }
    $config = $theme->config;
    try{
        $value = $config[$key] ;

    }catch(\Exception $e){
        $value = null;
    }
     return $value ;
}
