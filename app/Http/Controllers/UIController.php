<?php

namespace App\Http\Controllers;

use App\Http\Resources\UI\GetProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function get_products(Request $request)
    {
        $products = Product::
            when($request->chosenDepartments, function ($query) use ($request) {
                return $query->whereIn('department_id', $request->chosenDepartments);
            })
            ->when($request->chosenTrademarks, function ($query) use ($request) {
                return $query->whereIn('trademark_id', $request->chosenTrademarks);
            })
            ->inRandomOrder()
            ->paginate(12);

        $products = GetProductResource::collection($products);
        return response($products->response()->getData(true), 200);
    }
    public function get_product($id)
    {
        return response(new GetProductResource(Product::find(decrypt($id))));
    }

    public function get_related_products($department_id)
    {
        $products = GetProductResource::collection(Product::where('department_id', $department_id)->inRandomOrder()->limit(4)->get());
        return response($products, 200);
    }
    public function get_orders()
    {
        $orders = Order::where('id' , request()->user()->id)->with('products')->get();
        return response($orders , 200);
    }
}
