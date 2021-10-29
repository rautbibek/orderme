<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id','desc')->paginate(10);
        return response()->json($brands);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required| max:90 |unique:brands',
            'product_type_id' => 'required'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->product_type_id = $request->product_type_id ;
        $brand->save();
        return response()->json([
            'message'=>'New brand added succefully',
            'category' => $brand
        ], 201);
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
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required| max:90 ',
            'product_type_id' => 'required'
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->product_type_id = $request->product_type_id ;
        $brand->save();
        return response()->json([
            'message'=>'New brand added succefully',
            'category' => $brand
        ], 200);
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

    public function brandProductType($productType){
        $brand = Brand::where('product_type_id', $productType)->get();
        return response()->json($brand);
    }
}
