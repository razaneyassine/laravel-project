<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Base;

class BaseController extends Base
{
    protected $url = '';

    /**
     * BaseController constructor.
     *
     */
    public function __construct()
    {
        $this->url = 'https://'.env('API_KEY').':'.env('API_PASSWORD').'@'.env('HOST_NAME');
    }

    protected function performRequest($url){
        $client =  new \GuzzleHttp\Client(['verify' => false ]);
        $response = $client->request('GET', $this->url.$url);
        return $response->getBody();
    }
}
