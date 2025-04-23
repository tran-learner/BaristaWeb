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
    $amount = 100000;
    $orderCode = uniqid('ORD_');
    $returnUrl = route('payment.success');
    $cancelUrl = route('payment.cancel');

    $payment = $this->payOS->createPayment($amount, $orderCode, $returnUrl, $cancelUrl);

    // 🔍 Debug: dump the full response
    \Log::info('PayOS response:', $payment);
    dd($payment); // <-- stop here and see what PayOS returned

    if (isset($payment['data']['qrCode'])) {
        return view('payment.qr', ['qrCodeUrl' => $payment['data']['qrCode']]);
    }

    return redirect()->back()->with('error', 'Could not generate QR code.');
    }


    public function success()
    {
        return '✅ Payment was successful!';
    }

    public function cancel()
    {
        return '❌ Payment was cancelled.';
    }
}
