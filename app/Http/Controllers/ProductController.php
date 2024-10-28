<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //TODO Create and save the Product using validated data
        $product = Product::create($request->validated());

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'Product created successfully!',
            'data' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //TODO Update the Product with validated data
        $product->update($request->validated());

        //TODO Return a success response
        return response()->json([
            'message' => 'Product updated successfully!',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //TODO Delete the brand
        $product->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Product deleted successfully!',
        ], 200);
    }
}
