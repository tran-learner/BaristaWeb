<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayOSService;

class PaymentController extends Controller
{
    protected $payOS;

    public function __construct(PayOSService $payOS)
    {
        $this->payOS = $payOS;
    }

    public function create()
    {
        $amount = 100000; // 100,000 VND
        $orderCode = uniqid('ORD_');
        $returnUrl = route('payment.success');
        $cancelUrl = route('payment.cancel');

        $payment = $this->payOS->createPayment($amount, $orderCode, $returnUrl, $cancelUrl);

        if (isset($payment['data']['qrCode'])) {
            return view('payment.qr', ['qrCodeUrl' => $payment['data']['qrCode']]);
        }

        return redirect()->back()->with('error', 'Failed to generate QR code.');
    }

    public function success()
    {
        return response('✅ Payment successful!', 200);
    }

    public function cancel()
    {
        return response('❌ Payment cancelled.', 200);
    }
}
