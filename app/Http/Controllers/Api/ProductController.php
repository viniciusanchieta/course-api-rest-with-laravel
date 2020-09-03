<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;

use Illuminate\Http\Request;

class ProductController extends ApiController
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product;

        if($request->has('conditions')){
            $expressions = explode(';',$request->get('conditions'));

            foreach ($expressions as $e) {
                $exp = explode(':', $e);
                // If exist two parameters operator is '=' if exist three, second is the operator
                $products = $products->where($exp[0],$exp[1],$exp[2]);
            }
        }

        if($request->has('fields')){
            $fields = $request->get('fields');
            $products = $products->selectRaw($fields);
        }

        return new ProductCollection($products->paginate(10));
    }

    public function show($id)
    {
        $product = Product::find($id);
        // return $this->sendResponse($products,"Retorno com sucesso");

        return new ProductResource($product);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        return $this->sendResponse($product, "Retorno com sucesso");
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $product = Product::find($data['id']);
        $product->update($data);

        return $this->sendResponse($product, "Retorno com sucesso");
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->sendResponse($product, "Product removed");
    }
}
