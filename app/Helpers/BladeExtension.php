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

function getLayout(){
    $theme = \App\Models\Theme::where('active', true)
        ->first();
    if(!$theme){
        $theme = \App\Models\Theme::where('slug', 'molla')
            ->first();
    }

    return "themes.$theme->slug.template.layout";
}

function getCollection($key){

    $products  = \Illuminate\Support\Facades\DB::table('products')
        ->join('collection_product', 'products.id', '=', 'collection_product.product_id')
        ->join('collections', 'collections.id', '=', 'collection_product.collection_id')
        ->where('collections.id', $key)
        ->rightJoin('variants', function ($rightJoin) {
            $rightJoin->on('variants.product_id', '=', 'products.id')
                ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
        })
        ->select('products.*', 'variants.price', 'variants.old_price')
        ->get();

    return $products;

}

function productImage(int $key){
    $product = \App\Models\Product::where('id', $key)->first();
    return $product->image[0] ?? "";
}
