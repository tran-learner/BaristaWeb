<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PayOSService
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->client = new Client();
        $this->config = [
            'client_id' => env('PAYOS_CLIENT_ID'),
            'api_key' => env('PAYOS_API_KEY'),
            'checksum_key' => env('PAYOS_CHECKSUM_KEY'),
            'return_url' => env('PAYOS_RETURN_URL'),
            'cancel_url' => env('PAYOS_CANCEL_URL'),
            'endpoint' => env('PAYOS_ENDPOINT'),
        ];
    }

    public function createPaymentLink(array $data)
    {
        $orderCode = time() . rand(1000, 9999);

        $payload = [
            'orderCode' => (int)$orderCode,
            'amount' => (int)$data['amount'],
            'description' => $data['description'] ?? "Payment for order $orderCode",
            'items' => [
                [
                    'name' => $data['item_name'] ?? 'Product 1',
                    'quantity' => $data['quantity'] ?? 1,
                    'price' => (int)$data['amount'],
                ]
            ],
            'returnUrl' => $this->config['return_url'],
            'cancelUrl' => $this->config['cancel_url'],
            'buyerName' => $data['buyer_name'] ?? null,
            'buyerEmail' => $data['buyer_email'] ?? null,
            'buyerPhone' => $data['buyer_phone'] ?? null,
            'expiredAt' => now()->addMinutes(15)->getTimestamp(),
        ];

        Log::info('PayOS Request Payload:', $payload);

        try {
            $response = $this->client->post($this->config['endpoint'] . '/v2/payment-requests', [
                'headers' => [
                    'x-client-id' => $this->config['client_id'],
                    'x-api-key' => $this->config['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
                'http_errors' => false,
            ]);

            $responseData = json_decode($response->getBody(), true);
            Log::info('PayOS API Response:', $responseData);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception($responseData['desc'] ?? 'Unknown error from PayOS');
            }

            return $responseData['data']['checkoutUrl'];

        } catch (\Exception $e) {
            Log::error('PayOS Error: ' . $e->getMessage());
            throw new \Exception("Payment failed: " . $e->getMessage());
        }
    }

    public function validateWebhook(array $data)
    {
        $dataStr = json_encode($data['data']);
        $signature = hash_hmac('sha256', $dataStr, $this->config['checksum_key']);
        return hash_equals($signature, $data['signature']);
    }
}