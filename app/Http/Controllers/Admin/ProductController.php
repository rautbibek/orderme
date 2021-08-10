<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $product = new Product();
            $product->title = $request->title;
            $product->category_id = $request->category_id;
            $product->product_type_id = $request->product_type_id;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->cart_system = true;
            $product->inventory_track = true;
            $product->admin_id = Auth::id();
//        $product->options = json_encode($request->options);
            $product->out_of_stock = $request->out_of_stock;
            $product->featured = $request->featured;
            $product->meta_tag_title = $request->meta_tag_title;
            $product->meta_tag_description = $request->meta_tag_description;
            $product->meta_tag_keyword = $request->meta_tag_keyword;
            $product->image = json_encode($request->image);
//        $collection = \App\Models\Collection::findOrFail($collection_id);

            $product->save();
            $product->collections()->attach($request->collections);

            foreach($request->variants as $variant){

                $variance = new Variant([
                    'quantity' => $variant['quantity'],
                    'code' => $variant['code'],
                    'price' => $variant['price'],
                    'old_price' => $variant['old_price'],
                ]);
                $variance->features = $variant['features'];
                $batch_variant[] = $variance;
            }

            $product->variants()->saveMany($batch_variant);


        DB::commit();
        return response()->json([
            'message'=>'Product Added successfully',
            'product' => $product
        ], 201);

        }catch(\Exception $exception){
            Log::error($exception);
            DB::rollBack();
            return $exception;
        }


            // return response()->json([
            //     'message'=>'New product added successfully',
            //     //'product' => $product
            // ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['variants'])->findOrFail($id);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $product->title = $request->title;
            $product->category_id = $request->category_id;
            $product->product_type_id = $request->product_type_id;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
//        $product->options = json_encode($request->options);
            $product->image = json_encode($request->image);
            $product->out_of_stock = $request->out_of_stock;
            $product->featured = $request->featured;
            $product->meta_tag_title = $request->meta_tag_title;
            $product->meta_tag_description = $request->meta_tag_description;
            $product->meta_tag_keyword = $request->meta_tag_keyword;
            $collection_id = $request->collection_id;
//        $collection = \App\Models\Collection::findOrFail($collection_id);
            $product->update();
            $product->collections()->sync($request->collections);

            foreach($product->variants as $checkVariant)
            {
                $deletetedVariant = array_search($checkVariant->id, array_column($request->variants, 'id'));
                if($deletetedVariant === false){
                    $checkVariant->delete();
                }

            }

            foreach($request->variants as $variant){

                if(!isset($variant['quantity']) && !isset($variant['price']) ){
                    continue ;
                }

                if(!!($variant['id'] ?? null)){
                    $entryVariant = Variant::findOrFail($variant['id']);
                    $entryVariant->features = $variant['features'];
                    $entryVariant->update([
                        'quantity' => $variant['quantity'],
                        'code' => $variant['code'],
                        'price' => $variant['price'],
                        'old_price' => $variant['old_price'],
                    ]);

                }else{
                    $batch_variant = new Variant([
                        'quantity' => $variant['quantity'],
                        'code' => $variant['code'],
                        'price' => $variant['price'],
                        'old_price' => $variant['old_price'],
                    ]);
                    $batch_variant->features = $variant['features'];

                    $product->variants()->save($batch_variant);

                }
            }
            DB::commit();
            return response()->json([
                'message'=>'Product Added successfully',
                'product' => $product
            ], 200);

        }catch(\Exception $e){
            Log::error($exception);
            DB::rollBack();
            return $exception;
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
