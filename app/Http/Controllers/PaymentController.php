<?php

namespace App\Http\Controllers;

use App\Services\PayOSService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payOSService;

    public function __construct(PayOSService $payOSService)
    {
        $this->payOSService = $payOSService;
    }

    public function showCheckoutForm()
    {
        return view('checkout');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
            'buyer_name' => 'nullable|string|max:100',
            'buyer_email' => 'nullable|email',
            'buyer_phone' => 'nullable|string|max:20',
        ]);

        try {
            $checkoutUrl = $this->payOSService->createPaymentLink($request->all());
            return redirect()->away($checkoutUrl);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function handleCallback(Request $request)
    {
        $status = $request->input('status');
        $orderCode = $request->input('orderCode');

        return $status === 'PAID'
            ? view('payment.success', compact('orderCode'))
            : view('payment.failed', compact('orderCode'));
    }

    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        if (!$this->payOSService->validateWebhook($data)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Xử lý logic đơn hàng tại đây
        Log::info('Webhook processed:', $data);

        return response()->json(['success' => true]);
    }
}