<?php

use App\Models\Order;

function getConfig(string $key){
    $theme = \App\Models\Theme::where('active', true)
        ->first();
    if(!$theme){
        $theme = \App\Models\Theme::where('slug', 'molla')
            ->first();
    }
    try{
        $config = $theme->config;
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
        ->where('products.active', true)
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
    return $product->image[0] ?? "/no-image.jpg";
}

function getCollectionName(int $key){
    return \App\Models\Collection::where('id', $key)->first()->name ?? '';
}

function allCategory(){
    $categories = \App\Models\Category::all();
    return $categories->take(10);
}

function getMenu($key){
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
    $menu = \App\Models\Menu::where('id', $value)->first();


    return ['name' => $menu->name ?? '' , 'design' => $menu->design ?? []] ?? [];
}

function menuUrl($key){
    switch ($key['reference']) {
        case "Category":
            $category = \App\Models\Category::where('id', $key['value'])->first();
            return route('category', ['slug' => $category->slug]);
        case "Collection":
            $collection = \App\Models\Collection::where('id', $key['value'])->first();
            return route('collection', ['slug' => $collection->slug]);
        case "Page":
            $page = \App\Models\Page::where('id', $key['value'])->first();
            return route('page', ['slug' => $page->slug]);
        case "Brand":
            $brand = \App\Models\Brand::where('id', $key['value'])->first();
            return route('brand', ['slug' => $brand->slug]);
        case "Service":
            $service = \App\Models\Service::where('id', $key['value'])->first();
            return route('service', ['slug' => $service->slug]);
        default:
            return $key['value'];
    }
}

function cartItem(){
    $cart = session()->get('cart');
    if(!$cart){
        return 0;
    }
    $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();
    $cartCount = $order->cartItems()->count();
    return $cartCount;
}

