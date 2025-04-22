<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayOSService
{
    protected $baseUrl;
    protected $clientId;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.payos.base_url');
        $this->clientId = config('services.payos.client_id');
        $this->apiKey = config('services.payos.api_key');
    }
    
    public function createPayment($amount, $orderCode, $returnUrl, $cancelUrl)
    {
        $response = Http::withHeaders([
            'x-client-id' => $this->clientId,
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/payments/create', [  // NOTE: added /v1 here
            'orderCode' => $orderCode,
            'amount' => $amount,
            'description' => 'Order #' . $orderCode,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
        ]);
        

        return $response->json();
    }
}
