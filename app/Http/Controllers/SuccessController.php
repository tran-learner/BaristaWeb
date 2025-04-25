<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessController extends Controller
{
    //
    public function success(Request $request)
    {
        $paymentData = session('paymentData');
        if ($paymentData) {
            return view('success', ['paymentData' => $paymentData]);
        } else {
            return redirect('/');
        }
    }
}
