<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceExpert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experts = ServiceExpert::orderBy('id','desc')->paginate(10);
        return response()->json($experts);
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
        $expert = new ServiceExpert();
        $expert->name = $request->name;
        $expert->image = $request->image;
        $expert->phone  = $request->phone;
        $expert->email = $request->email;
        $expert->description = $request->description;
        $expert->province = $request->province;
        $expert->city = $request->city;
        $expert->service_id = $request->service_id;
        $expert->active = $request->active;
        $expert->address = $request->address;
        $expert->experience = $request->experience;
        $expert->save();
        return response()->json($expert, 201);


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
        $expert = ServiceExpert::findOrFail($id);
        return response()->json($expert);
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
        $expert = ServiceExpert::findOrFail($id);
        $expert->name = $request->name;
        $expert->image = $request->image;
        $expert->phone  = $request->phone;
        $expert->email = $request->email;
        $expert->description = $request->description;
        $expert->province = $request->province;
        $expert->city = $request->city;
        $expert->service_id = $request->service_id;
        $expert->active = $request->active;
        $expert->address = $request->address;
        $expert->experience = $request->experience;
        $expert->save();
        return response()->json($expert, 200);
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
