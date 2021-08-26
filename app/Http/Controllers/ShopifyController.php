<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopifyController extends BaseController
{
    public function index(){
        return $this->performRequest('/2021-07/products.json');
    }

    public function collections(){
        return $this->performRequest('/2021-07/smart_collections.json');
    }

    public function trending(){
      $response=$this->performRequest('/2021-07/smart_collections.json');
      $filtered=collect($response)->where('title','Trending');
      return $response;
    }


    public function signUp(Request $request){
        return $this->postRequest('/2021-07/customers.json', $request->all());
    }

    public function getCustomers(){
        return $this->performRequest('2021-07/customers.json');
    }
}
