<?php

namespace App\Http\Controllers;

use PayOS\PayOS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $payOS;

    public function __construct()
    {
        $clientId = config('payos.client_id');
        $apiKey = config('payos.api_key');
        $checksumKey = config('payos.checksum_key');

        if (!$clientId ||!$apiKey ||!$checksumKey) {
            Log::error('PayOS credentials are not configured properly.');
            // Optionally throw an exception or handle the error appropriately
            throw new \Exception('PayOS credentials are not configured properly.');
        }

        // Initialize PayOS SDK instance
        $this->payOS = new PayOS($clientId, $apiKey, $checksumKey);
        // Or with optional partner code:
        // $this->payOS = new PayOS($clientId, $apiKey, $checksumKey, config('payos.partner_code'));
    }

    //... payment methods will use $this->payOS...
}