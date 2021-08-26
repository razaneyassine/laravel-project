<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Base;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

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
        try {
            $client =  new \GuzzleHttp\Client(['verify' => false ]);
            $response = $client->request('GET', $this->url.$url);
            return $response->getBody();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }



    protected function postRequest($url,$body){
        try{
            $client =  new \GuzzleHttp\Client(['verify' => false ]);
            $response = $client->request('POST', $this->url.$url,["json" => $body, "headers" => ['content-type'=>'application/json']]);
            return $response->getBody();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
