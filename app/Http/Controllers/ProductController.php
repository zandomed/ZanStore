<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();
        return baseJsonResponse($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        try {
            $validatedData = $request->validated();
            $product = Product::create($validatedData);
        } catch (\Throwable $th) {
            return baseJsonResponse(null, 500, false, $th->getMessage());
        }

        return baseJsonResponse($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return baseJsonResponse($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $product->fill($validatedData);
        $product->save();
        return baseJsonResponse($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return baseJsonResponse(null, 204);
    }
}
