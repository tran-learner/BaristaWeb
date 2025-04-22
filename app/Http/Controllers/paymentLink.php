<?php

namespace App\Http\Controllers;


use PayOS\PayOS;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order; // Assuming you have an Order model

class YourPaymentController extends Controller // Or OrderController etc.
{
    protected $payOS;

    public function __construct()
    {
        $clientId = config('payos.client_id');
        $apiKey = config('payos.api_key');
        $checksumKey = config('payos.checksum_key');

        if (!$clientId ||!$apiKey ||!$checksumKey) {
            Log::error('PayOS credentials are not configured properly.');
            throw new \Exception('PayOS configuration error.');
        }

        $this->payOS = new PayOS($clientId, $apiKey, $checksumKey);
        // Or with optional partner code:
        // $this->payOS = new PayOS($clientId, $apiKey, $checksumKey, config('payos.partner_code'));
    }

    public function initiatePayment(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId); // Get your order details

    // Generate a unique INTEGER orderCode for this specific PayOS attempt
    $payOSOrderCode = intval(substr(strval(microtime(true) * 10000), -6). $order->id);

    $data =;
        })->toArray(),
        'cancelUrl' => route('payment.cancel', ['order_id' => $order->id]), // Use named routes
        'returnUrl' => route('payment.return', ['order_id' => $order->id]), // Use named routes
        // Optional buyer info
        'buyerName' => $order->customer_name,
        'buyerEmail' => $order->customer_email,
        'buyerPhone' => $order->customer_phone,


    try {
        $response = $this->payOS->createPaymentLink($data);

        // Store the payOSOrderCode and paymentLinkId with your order for webhook matching
        $order->payos_order_code = $payOSOrderCode;
        $order->payment_link_id = $response['paymentLinkId']?? null;
        $order->status = 'pending_payment'; // Update local status
        $order->save();

        // Redirect user to PayOS checkout page
        return Redirect::away($response['checkoutUrl']);

    } catch (\Throwable $th) {
        Log::error('PayOS Payment Link Creation Failed: '. $th->getMessage());
        return redirect()->back()->with('error', 'Payment gateway error. Please try again.');
    }
}
}