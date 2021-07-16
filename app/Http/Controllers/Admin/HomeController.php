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
        
        $category = ProductType::where("field->type", 5)->get();

        $collection = collect($category)->map(function ($name) {
            return $name;

        return response()->json($collection, 200);
    }
}
