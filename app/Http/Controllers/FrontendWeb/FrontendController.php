<?php

namespace App\Http\Controllers\FrontendWeb;
use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Collection;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceExpert;
use App\Models\Theme;
use App\Models\ProductType;

use App\Models\User;
use App\Models\Variant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
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

    public function categoryPage($slug){
        $theme = Theme::find(['active' => true])->first();

        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::where('parent_id',null)->get();

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

         return view("themes.$theme->slug.template.category", compact('products', 'category','categories'));

    }

    public function collectionPage($slug){
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

    public function pageView($slug){
        $theme = Theme::find(['active' => true])->first();

        $page = Page::where('slug', $slug)->firstOrFail();

        return view("themes.$theme->slug.template.page", compact('page'));

    }

    public function searchPage(Request $request){
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

    function cartAction(Request $request){
//        $checkout_referer =  $request->session()->get('checkout');
//        dd($checkout_referer);
//        dd(session()->all());

        $theme = Theme::find(['active' => true])->first();
        $cart = session()->get('cart');
        if($cart){
            $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();
        }else{
            $order = [];
        }

        return view("themes.$theme->slug.template.cart", compact('order'));
    }

    public function addToCartAction(Request $request){

        $cart = $request->session()->get('cart');
        if(!$cart){
            $order =  new Order();
            $order->uuid = Uuid::uuid4();
            $order->state = 'cart';
            $order->payment_state = 'cart';
            $order->shipping_state =  'cart';
            $order->checkout_state = 'cart';
            $order->save();
            session()->put('cart', $order->uuid);
        }else{
            $order =  Order::where('uuid', $cart)->first();
        }
        $variant = Variant::where('id', $request->variant)->first();

        $cartItem = new CartItem();
        $cartItem->order_id = $order->id;
        $cartItem->variant_id = $request->variant;
        $cartItem->quantity = $request->quantity;
        $cartItem->unit_price = $variant->price * 100;
        $cartItem->unit_total = $variant->price * 100 * $request->quantity;
        $cartItem->total = $variant->price * 100 * $request->quantity;
        $cartItem->save();

        $order->items_total = $order->cartItems()->sum('unit_total');
        $order->total =  $order->cartItems()->sum('total');
        $order->save();

       return redirect()->route('cart');

    }

    public function checkoutAction(Request $request){
        $theme = Theme::find(['active' => true])->first();
        $cart = session()->get('cart');
        if(!$cart){
            return redirect()->route('welcome');
        }
        $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();
        $order->user_id = Auth::id();
        $order->save();
        $shipping_address = CustomerAddress::where('user_id', Auth::id())->get();
        return view("themes.$theme->slug.template.checkout", compact('order', 'shipping_address'));
    }

    public function addressAction(Request $request){

        $theme = Theme::find(['active' => true])->first();
        $cart = session()->get('cart');
        if(!$cart){
            return redirect()->route('welcome');
        }

        $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();

        if($order->adjustment_total != 0) {
            return view("themes.$theme->slug.template.confirm", compact('order'));
        }
        $addressSelect = $request->address_selected;
        if(isset($addressSelect)){
            $order->customer_address_id = $addressSelect;
        }else{

            $address = new CustomerAddress();
            $address->name = $request->name;
            $address->user_id = Auth::id();
            $address->phone_number = $request->phone;
            $address->street1 = $request->street1;
            $address->street2 = $request->street2;
            $address->save();
            $order->customer_address_id = $address->id;
        }

        $order->adjustment_total = 12000;
        $order->total = $order->total + 12000;
        $order->save();

        return view("themes.$theme->slug.template.confirm", compact('order'));
    }

    public function orderCompleteAction(){
        $theme = Theme::find(['active' => true])->first();
        $cart = session()->get('cart');
        if(!$cart){
            return redirect()->route('welcome');
        }

        $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();
        if(!$order->customer_address_id){
            return redirect()->route('welcome');
        }
        $order->checkout_state = 'completed';
        $order->state = 'new';
        $order->payment_state = 'awaiting_payment';
        $order->shipping_state = 'ready';
        $order->save();
        session()->forget(['checkout', 'cart']);

        return redirect('/me#/orders');

    }

    public function updateCartAction(Request $request){
        $cart = session()->get('cart');
        if(!$cart){
            return redirect()->route('welcome');
        }
        $order = Order::where('uuid', $cart)->with('cartItems.variant.product')->first();
        $cartItem =  CartItem::where('order_id', $order->id)->where('variant_id', $request->variant)->first();
        $cartItem->quantity = $request->quantity;
        $cartItem->unit_total = $cartItem->unit_price * $request->quantity;

        $cartItem->save();
        $order->items_total = $order->cartItems()->sum('unit_total');
        $order->total =  $order->cartItems()->sum('total');
        $order->save();

        return redirect()->route('cart');

    }

    public function serviceView($slug){
        $theme = Theme::find(['active' => true])->first();

        $service = Service::where('slug', $slug)->firstOrFail();

        $experts = ServiceExpert::where('service_id', $service->id)->get();

        return view("themes.$theme->slug.template.service", compact('service', 'experts'));

    }

    public function brandView($slug){
        $theme = Theme::find(['active' => true])->first();

        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = \Illuminate\Support\Facades\DB::table('products')
            ->where('products.active', true)
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.slug', $slug)
            ->rightJoin('variants', function ($rightJoin) {
                $rightJoin->on('variants.product_id', '=', 'products.id')
                    ->where('variants.quantity', '=', \Illuminate\Support\Facades\DB::raw("(SELECT MAX(quantity) FROM bt_variants WHERE product_id = bt_products.id)"));
            })
            ->select('products.*', 'variants.price', 'variants.old_price')
            ->paginate(20)
        ;

        return view("themes.$theme->slug.template.brand", compact('products', 'brand'));


    }

    public function expertView($slug){
        $theme = Theme::find(['active' => true])->first();
        $expert = ServiceExpert::where('slug', $slug)->first();
        return view("themes.$theme->slug.template.expert", compact('expert'));

    }


}
