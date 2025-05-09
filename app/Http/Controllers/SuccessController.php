<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SuccessController extends Controller
{
    //
    public function success(Request $request)
    {

        // Get the orderCode from the URL
        $orderCode = $request->query('orderDB');

        // Retrieve the order data from the session
        $orderData = session('orderDB');

        if (!$orderData) {
            return redirect('/')->with('error', 'Order not found or already processed.');
        }

        // Save to Supabase
        Order::create($orderData);

        $paymentData = session('paymentData');
        if ($paymentData) {
            return view('success', ['paymentData' => $paymentData]);
        } else {
            return redirect('/');
        }
    }
}
