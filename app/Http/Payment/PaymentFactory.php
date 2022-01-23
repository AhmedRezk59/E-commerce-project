<?php

namespace App\Http\Payment;

use App\Http\Requests\PaymentFactoryRequest;

class PaymentFactory
{
    public function redirect(PaymentFactoryRequest $request)
    {
        $payment_method = $request->payment_method;
        switch ($payment_method) {
            case 'CASH':
                $payment_method = new CashPayment();
                break;
            case 'CREDIT':
                $payment_method = new MyFatoorahPayment();
                break;
        }
        return $payment_method->pay();
    }
}
