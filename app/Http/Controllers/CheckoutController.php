<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function createPaymentLink(Request $request)
    {
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => 2000,
            "description" => "Drinking payment",
            "returnUrl" => $YOUR_DOMAIN . "/success",
            "cancelUrl" => $YOUR_DOMAIN . "/ingredients"
        ];
        error_log($data['orderCode']);

        try {
            $response = $this->payOS->createPaymentLink($data);
            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
