<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.checkout_state', '=', 'completed')
            ->orderBy('id','desc')
            ->select('orders.id', 'orders.uuid', 'orders.state', 'orders.created_at', 'orders.total', 'users.name')->paginate(10);
        return response()->json($orders);
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
    public function store(Request $request)
    {
        //
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
        $order =  Order::where('id', $id)->with('user', 'customerAddress', 'cartItems.variant.product')->first();
        return response()->json($order);
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
        //
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

    public function confirmOrder($uuid){
        $order = Order::where('uuid', $uuid)->first();
        if($order->state === 'new'){

            $order->state = 'confirmed';
            $order->save();
        }

        return response()->json($order);
    }
    public function confirmShipped($uuid){
        $order = Order::where('uuid', $uuid)->first();
        if($order->state === 'confirmed' && $order->shipping_state === 'ready'){

            $order->shipping_state = 'shipped';
            $order->state = 'completed';
            $order->save();
        }

        return response()->json($order);
    }

    public function confirmPayment($uuid){
        $order = Order::where('uuid', $uuid)->first();

        $order->payment_state = 'completed';
        $order->state = 'confirmed';
        $order->save();
        $user = User::where('id', $order->user_id)->first();
//        Adding 1 % of total amount to point value

        $user->point_value = $user->point_value + $order->total / 10000;
        $user->save();

//        Adding 0.5% of total amount to point value
        $refUser = User::where('id', $user->reference_id)->first();
        if(!!$refUser && !!$refUser->id){
            $refUser->point_value = $refUser->point_value + $order->total /20000;
            $refUser->save();
        }


        return response()->json($order);
    }
}
