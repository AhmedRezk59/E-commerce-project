<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Resources\Cart\GetCartResource;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = GetCartResource::collection(User::find($request->user()->id)->cart);
        return response($cart, 200);
    }

    public function store(StoreCartRequest $request)
    {
        Cart::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'user_id' => $request->user()->id,
            ],
            ['quantity' => $request->quantity]
        );
        $cart = GetCartResource::collection(User::find($request->user()->id)->cart);
        return response($cart, 200);
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        User::where('id', request()->user()->id)->first()->cart()->detach($id);
        $cart = GetCartResource::collection(User::find(request()->user()->id)->cart);
        return response($cart, 200);
    }
}
