<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $users = User::orderBy('id','desc')->paginate(10);

        return response()->json($users, 200);
    }

    public function edit($id){
        $customer = User::findOrFail($id);

        return response()->json($customer);
    }

    public function update(CustomerRequest $request,$id)
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
