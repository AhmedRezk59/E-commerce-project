<?php

namespace App\Http\Payment;

use App\Http\Services\FatoorahService;
use App\Http\Traits\PriceTrait;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class MyFatoorahPayment implements PaymentInterface
{

    use PriceTrait;

    private $fatoorahService;
    public function __construct()
    {
        $this->fatoorahService = new FatoorahService();
    }

    public function pay()
    {
        $total_price = $this->get_total_price();
        $data = [
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => (string) $total_price,
            'CustomerName'       => request()->user()->name,
            'DisplayCurrencyIso' => 'EGP',
            'CustomerEmail'      => request()->user()->email,
            'CallBackUrl'        => env('FATOORAH_SUCCESS'),
            'ErrorUrl'           => env('FATOORAH_FAILED'),
            'Language'           => 'en',
        ];
        if ((float) $total_price > 0) {
            return $this->fatoorahService->sendPayment($data);
        }
        return 'No Products in the cart';
    }

    public function paymentCallBack(Request $request)
    {
        $data = [
            'Key'     => $request->paymentId,
            'KeyType' => 'paymentId'
        ];
        $payment_status = $this->fatoorahService->getPaymentStatus($data);
        $price = $payment_status['Data']['InvoiceDisplayValue'];
        $price = preg_replace("/[^0-9\.,]/", "", $price);
        $status = $payment_status['IsSuccess'];
        if ($status == true) {
            $userEmail = $payment_status['Data']['CustomerEmail'];
            $user = User::where('email', $userEmail)->first();
            $order = Order::create([
                'user_id' => $user->id,
                'payment_method' => $payment_status['Data']['InvoiceTransactions'][0]['PaymentGateway'],
                'total_price' => $price,
                'paid' => $price
            ]);
            $products_ids = $user->cart->pluck('id');
            $order->products()->sync($products_ids);
            $user->cart()->sync([]);
        }
        return redirect('/cart');
    }
}
