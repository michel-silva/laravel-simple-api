<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        return ProductsResource::collection(Product::paginate($request->per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        return ProductResource::make(Product::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ProductResource::make(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return ProductResource::make($product);
    }
}
