<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $users = User::orderBy('id','desc')->paginate(10);

        return response()->json($users, 200);
    }

    public function store(CustomerAddRequest $request){
        try{
            DB::beginTransaction();

            $customer = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'point_value' => 25,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return response()->json([
                'message'=>'Customer Added successfully',
                'product' => $customer
            ], 201);

        }catch(\Exception $e){
            Log::error($e);
            DB::rollBack();
            return $e;
        }
    }

    public function edit($id){
        $customer = User::findOrFail($id);

        return response()->json($customer);
    }

    public function update(CustomerUpdateRequest $request,$id)
    {
        try{
            DB::beginTransaction();
            $customer = User::findOrFail($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone_number = $request->phone_number;
            $customer->update();

            DB::commit();
            return response()->json([
                'message'=>'Customer Updated successfully',
                'customer' => $customer
            ], 200);
        }catch(\Exception $e){
            Log::error($e);
            DB::rollBack();
            return $e;
        }
    }

    public function destroy($id){
        
    }
}
