<?php

namespace App\Http\Controllers\FrontendWeb;
use App\Models\Category;
use App\Models\Product;
use App\Models\Theme;
use Illuminate\Support\Facades\DB;
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

    public function productDetail($id){
        $theme = Theme::find(['active' => true])->first();
        $product = Product::where('id', $id)->with('variants')->first();
        $productLike = DB::table('products')
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->where('products.category_id', $product->category_id)
            ->select('products.*', 'variants.price', 'variants.old_price')->get();

        if(count($productLike) > 8){
            $productLike = $productLike->random(8);
        }

        return view("themes.$theme->slug.template.productDetail", compact('product', 'productLike'));
    }
}
