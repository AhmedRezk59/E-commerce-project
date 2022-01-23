<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->with(['products', 'user'])->get();
        return response($orders, 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->validated());
        $products = $order->products;
        if ($request->status == 'ONTHEROAD' || $request->status == 'DELIVERED') {
            foreach ($products as $p) {
                $p->update([
                    'stock' => (int) $p['stock'] - 1
                ]);
            }
        }
        return response('Order Updated Successfully');
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
