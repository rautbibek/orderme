<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Menu;
use App\Models\Page;
use App\Models\ProductType;
use App\Models\Service;
use App\Models\ServiceExpert;
use http\Env\Response;
use Illuminate\Http\Request;

class SelectTableController extends Controller
{
    public function selectTable($type){
        switch ($type){
            case 'categories':
                $list = Category::all();
                break;
            case 'collections':
                $list = Collection::all();
                break;
            case 'pages':
                $list = Page::all();
                break;
            case 'menus':
                $list = Menu::all();
                break;
            case 'brand':
                $list = Brand::all();
                break;
            case 'product-type':
                $list = ProductType::all();
                break;
            case 'service':
                $list = Service::all();
                break;
            default:
                return $list = [];
        }

        return response()->json($list);

    }
}
