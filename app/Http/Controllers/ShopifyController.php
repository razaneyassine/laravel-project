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
        try {
            $response=$this->performRequest('/2021-07/smart_collections.json');
            $filtered=collect($response)->where('title','Trending');
            $rules = collect(json_decode($response)->smart_collections)->where('handle', 'trending')->flatten()[0]->rules;
            $products = collect(json_decode($this->index())->products);
            $data = [];
            foreach ($rules as $rule){
                switch ($rule->relation){
                    case 'contains':
                        $data = array_merge($data, $products->filter(function ($item) use ($rule)  {
                            // replace stristr with your choice of matching function
                            return false !== stripos($item->{$rule->column}, $rule->condition);
                        })->toArray());
                };
            }
            return $data;
        }catch (\Exception $e){
            return [];
        }
    }


    public function signUp(Request $request){
        return $this->postRequest('/2021-07/customers.json', $request->all());
    }

    public function getCustomers(){
        return $this->performRequest('2021-07/customers.json');
    }
}
