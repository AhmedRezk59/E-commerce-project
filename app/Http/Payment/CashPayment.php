<?php

namespace App\Http\Payment;

use App\Http\Traits\PriceTrait;
use App\Models\Order;
use App\Models\User;

class CashPayment implements PaymentInterface
{
    use PriceTrait;
    public function pay()
    {
        $user = User::where('id', request()->user()->id)->first();
        $price = $this->get_total_price();

        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => 'CASH',
            'total_price' => $price,
            'paid' => 0
        ]);
        
        $products_ids = $user->cart->pluck('id');
        $order->products()->sync($products_ids);
        $user->cart()->sync([]);

        return response('Successfull Payment', 200);
    }
}
