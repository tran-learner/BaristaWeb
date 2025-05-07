<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PayOS\PayOS;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected PayOS $payOS;

    public function __construct()
    {
        $this->payos = new PayOS(
            config('payos.client_id'),
            config('payos.api_key'),
            config('payos.checksum_key')
        );
    }


    protected function handleException(\Throwable $th)
    {
        return response()->json([
            "error" => $th->getCode(),
            "message" => $th->getMessage(),
            "data" => null
        ]);
    }
}
