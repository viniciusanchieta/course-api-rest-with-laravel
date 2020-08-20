<?php

namespace App\Http\Controllers\Api;

use App\Product;

use Illuminate\Http\Request;

class ProductController extends ApiController
{
    private $product;
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        $products = $this->product->all();
        return $this->sendResponse($products,"Retorno com sucesso");
        return response()->json($products);
    }
}
