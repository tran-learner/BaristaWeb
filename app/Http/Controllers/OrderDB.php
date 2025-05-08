<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderDB extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string',
            'Price' => 'required|integer',
            'Ordercode' => 'required|string',
        ]);

        $order = Order::create([
            'drink' => $validated['Name'],
            'price' => $validated['Price'],
            'Ordercode' => $validated['Ordercode'],
            'ordered_time' => Carbon::now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
}
