<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Request;


class Product extends Controller
{

    public function index(Request $request)
    {
        return \App\Models\Product::getProduct($request)->get();
    }

    public function store(Requests\ProductRequest $request)
    {
        return \App\Models\Product::createProduct($request);
    }

    public function update(Requests\ProductRequest $request)
    {

        return \App\Models\Product::updateProduct(($request));
    }

    public function destroy(Request $request)
    {
        $product = \App\Models\Product::find($request->id);

        return $product ? $product->deleteOrFail() : false;
    }
}
