<?php

namespace App\Http\Traits;

use App\Models\User;
use Carbon\Carbon;
use Exception;

trait PriceTrait
{
    public function get_total_price()
    {
        $products = User::find(request()->user()->id)->cart;
        $todayDate = Carbon::now()->format('Y-m-d');
        $prices = [];
        foreach ($products as $product) {
            $nullable_end_offer_at = Carbon::make($product->end_offer_at);
            $end_offer_at_date = $nullable_end_offer_at ? $nullable_end_offer_at->format('Y-m-d') : null;

            $nullable_start_offer_at = Carbon::make($product->start_offer_at);
            $start_offer_at_date = $nullable_start_offer_at ? $nullable_start_offer_at->format('Y-m-d') : null;

            if ($todayDate > $end_offer_at_date || $todayDate < $start_offer_at_date && (int) $product->stock > 0) {
                array_push($prices, (int) $product->price * (int) $product->pivot->quantity);
            } else if ((int) $product->stock > 0) {
                array_push($prices, (int) $product->price_offer * (int) $product->pivot->quantity);
            } else {
                throw new Exception('No Products in the stock');
            }
        }
        $prices = array_sum($prices);
        return $prices;
    }
}
