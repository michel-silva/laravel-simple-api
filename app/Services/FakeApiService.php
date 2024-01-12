<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class FakeApiService {
    private $url_fake_api;
    private $client;

    public function __construct() 
    {
        $this->url_fake_api = config('core.url_fake_api');
        
        $this->client = new Client([
            'base_uri' => $this->url_fake_api
        ]);
    }

    public function getProducts() 
    {
        $products = $this->client->request('GET', '/products');

        return json_decode($products->getBody());
    }
}