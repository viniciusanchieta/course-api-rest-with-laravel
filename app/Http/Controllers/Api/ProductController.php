<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
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
    }

    public function show($id){
        $product = Product::find($id);
        // return $this->sendResponse($products,"Retorno com sucesso");

        return new ProductResource($product);
    }

    public function save(Request $request){
        $data = $request->all();
        $product = Product::create($data);
        return $this->sendResponse($product,"Retorno com sucesso");
    }

    public function update(Request $request){
        $data = $request->all();

        $product = Product::find($data['id']);
        $product->update($data);

        return $this->sendResponse($product,"Retorno com sucesso");
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return $this->sendResponse($product,"Product removed");
    }
}
