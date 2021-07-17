<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;

class HomeController extends Controller
{
    public function index(){
        
        return view('home');
    }

    public function productTypeList(){
        
        $productType = ProductType::all();
        // $productType = ProductType::where("field->type", 5)->get();

        // $collection = $category->map(function ($name) {
        //     return collect(json_decode($name['field'], true))->map(function($ok){
        //         return $ok;
        //     })->union(['id' => $name->id]);
        // });

        return response()->json($productType, 200);
    }
}
