<?php

namespace App\Http\Controllers;

class ShopifyController extends BaseController
{
    public function index(){
        return $this->performRequest('/2021-07/products.json');
    }
}
