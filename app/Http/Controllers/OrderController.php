<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrderController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
          'base_uri' => 'https://open.nhanh.vn/api/',
          'headers' => [
            'Authorization' => 'Bearer ' . env('NHANHVN_API_TOKEN'),
          ],
        ]);
    }

    public function getOrders($phone)
    {
      $response = $this->client->request('POST', 'order/index', [
          'form_params' => [
              'version' => '2.0',
              'appId' => env('NHANHVN_APP_ID'),
              'businessId' => env('NHANHVN_BUSINESS_ID'),
              'accessToken' => env('NHANHVN_ACCESS_TOKEN'),
              'statuses' => ['Success'],
              'data' => "{\"customerMobile\": \"$phone\"}"
          ],
      ]);

      return json_decode($response->getBody()->getContents());
    }
}
