<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FatoorahService
{

    private $client;
    private $base_url;
    private $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->base_url = env('FATOORAH_BASE_URL');
        $this->headers = [
            'Content-Type' => 'application/json',
            "Authorization" => 'Bearer ' . env('FATOORAH_Token')
        ];
    }

    private function buildRequest($uri, $method, $data = [])
    {
        $request  = new Request($method, $this->base_url . $uri, $this->headers);
        $response = $this->client->send($request, ['json' => $data]);

        $response = json_decode($response->getBody(), true);

        return $response;
    }

    public function sendPayment($data)
    {
        return  $this->buildRequest('v2/SendPayment', 'POST', $data);
    }

    public function getPaymentStatus($data)
    {
        return  $this->buildRequest('v2/getPaymentStatus', 'POST', $data);
    }
}
