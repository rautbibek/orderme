<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointValue;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(){

        return view('home');
    }

    public function getDashboardChart(){
        $customers = User::all()->count();
        $totalPoint = PointValue::where('transfer_to_admin', null)->get()->sum('point_value');
        $todayPoint = PointValue::whereDate('created_at', Carbon::today())->where('transfer_to_admin', null)->get()->sum('point_value');
        return response()->json(['customers' => $customers, 'totalPoint' => $totalPoint, 'todayPoint' => $todayPoint]);
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
