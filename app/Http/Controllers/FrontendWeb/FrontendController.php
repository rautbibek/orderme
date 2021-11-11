<?php

namespace App\Http\Controllers\FrontendWeb;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Page;
use App\Models\Product;
use App\Models\Theme;
use App\Models\ProductType;

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

    public function productDetail($slug){
        $theme = Theme::find(['active' => true])->first();
        $prod = Product::where('slug', $slug)->with('variants')->firstOrFail();
        $productLike = DB::table('products')
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->where('products.category_id', $prod->category_id)
            ->where('products.active', true)
            ->select('products.*', 'variants.price', 'variants.old_price')->get();

        if(count($productLike) > 8){
            $productLike = $productLike->random(8);
        }

        $productOptions = DB::table('variants')
                            ->where('variants.product_id', $prod->id)
                            ->select('variants.features', 'variants.id')
                            ->get()
            ;

        $pov = [];


        foreach($productOptions as $key => $option){
            $features = json_decode($option->features, true);

            $pov[$key]['id'] = $option->id;
            $op = '';
            $opArray = [];
            foreach(array_keys($features) as $featureKey){
                $string = $op.ucfirst($featureKey)." : ". strtoupper($features[$featureKey]);
                array_push($opArray, $string);
            }
            $pov[$key]['options'] = implode(' , ', $opArray);
        }

        return view("themes.$theme->slug.template.productDetail", compact('prod', 'productLike', 'pov'));
    }

    function categoryPage($slug){
        $theme = Theme::find(['active' => true])->first();

        $category = Category::where('slug', $slug)->firstOrFail();

        $products = \Illuminate\Support\Facades\DB::table('products')
            ->where('products.active', true)
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.slug', $slug)
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->select('products.*', 'variants.price', 'variants.old_price')
            ->paginate(20)
            ;

         return view("themes.$theme->slug.template.category", compact('products', 'category'));

    }

    function collectionPage($slug){
        $theme = Theme::find(['active' => true])->first();

        $collection = Collection::where('slug', $slug)->firstOrFail();

        $products  = \Illuminate\Support\Facades\DB::table('products')
            ->where('products.active', true)
            ->join('collection_product', 'products.id', '=', 'collection_product.product_id')
            ->join('collections', 'collections.id', '=', 'collection_product.collection_id')
            ->where('collections.slug', $slug)
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->select('products.*', 'variants.price', 'variants.old_price')
            ->paginate(20);

        return view("themes.$theme->slug.template.collection", compact('products', 'collection'));

    }

    function pageView($slug){
        $theme = Theme::find(['active' => true])->first();

        $page = Page::where('slug', $slug)->firstOrFail();

        return view("themes.$theme->slug.template.page", compact('page'));

    }

    function searchPage(Request $request){
        $theme = Theme::find(['active' => true])->first();
        $search = $request->input('search');

        $products = \Illuminate\Support\Facades\DB::table('products')
            ->where('products.title', 'ILIKE', "%{$search}%")
            ->where('products.active', true)
            ->orWhere('products.description', 'ILIKE', "%{$search}%")
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->select('products.*', 'variants.price', 'variants.old_price')
            ->paginate(20)
        ;

        return view("themes.$theme->slug.template.search", compact('products', 'search'));

    }
}
