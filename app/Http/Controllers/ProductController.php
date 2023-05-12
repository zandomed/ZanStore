<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

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
            $product = new Product($validatedData);
            $product->user_id = Auth::id();
            $product->save();
            return baseJsonResponse($product, 201);
        } catch (\Throwable $th) {
            return baseJsonResponse(null, 500, false, $th->getMessage());
        }

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

        $userId = Auth::id();
        if ($userId !== $product->user_id) {
            return baseJsonResponse(null, 403, false, 'You are not authorized to update this product.');
        }
        try {

            $validatedData = $request->validated();
            $product->fill($validatedData);
            $product->save();
            return baseJsonResponse($product);
        } catch (\Throwable $th) {
            return baseJsonResponse(null, 500, false, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $userId = Auth::id();

        if ($userId !== $product->user_id) {
            return baseJsonResponse(null, 403, false, 'You are not authorized to delete this product.');
        }

        try {
            $product->delete();
            return baseJsonResponse(null, 204);
        } catch (\Throwable $th) {
            return baseJsonResponse(null, 500, false, $th->getMessage());
        }
    }
}
