<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    public function index(){
        $url = 'https://bcc4677346426e146a6e0c63d4730dc5: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@razanes-store.myshopify.com/admin/api/2021-07/products.json';
        $client =  new \GuzzleHttp\Client(['verify' => false ]    );
        $response = $client->request('GET', $url);
        return $response->getBody();
    }
}
