<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function createPaymentLink(Request $request)
    {
        $requestBody = $request->all();
        // dd($requestBody['Price']);
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            // "amount" => 2000,
            "amount" => $requestBody['Price'] * 1000 ?? 10000,
            "description" => $requestBody['Name'],
            "returnUrl" => $YOUR_DOMAIN . "/success",
            "cancelUrl" => $YOUR_DOMAIN . "/",

        ];
        session([$orderDB => [
            'drink' => $requestBody['Name'],
            'price' => $requestBody['Price'] * 1000 ?? 10000,
            'Ordercode' => $data['orderCode'],
            'ordered_time' => now(), // Current timestamp
        ]]);
        unset($requestBody['Price']);
        unset($requestBody['Name']);
        // error_log($data['orderCode']);
        session(['paymentData' => $requestBody]);
        try {
            $response = $this->payOS->createPaymentLink($data);
            return response()->json([
                'checkoutUrl' => $response['checkoutUrl']
            ]);
            // return response()->json($requestBody);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
