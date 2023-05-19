<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TransactionService
{
    public function processTransaction($orderId, $amount)
    {
        $dummySuccessResponse = [
            'order_id' => $orderId,
            'amount' => $amount,
            'status' => 1
        ];

        return $dummySuccessResponse;

        try {
            $response = Http::withHeaders(
                [
                    'Authorization' => 'Bearer ' . base64_encode('SuryoPrasetyoWibowo'),
                ]
            )->post('https://yourdomain.com/deposit', [
                'order_id' => $orderId,
                'amount' => $amount,
                'timestamp' => time(),
            ]);

            return $response->json();
        } catch (\Exception $err) {
            return [
                'status' => 0,
                'error' => $err->getMessage(),
            ];
        }
    }
}
