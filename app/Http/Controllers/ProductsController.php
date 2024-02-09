<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function browse(): AnonymousResourceCollection
    {
        return ProductResource::collection(Products::all());
    }

    /**
     * Display the specified resource.
     */
    public function read(Products $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, Products $product): JsonResponse
    {
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');

        $updateCols = [];
        if ($product_name !== null) {
            $updateCols = ['name' => $product_name];
        }

        if ($product_price !== null) {
            $updateCols = ['price' => $product_price];
        }

        if ($product_description !== null) {
            $updateCols = ['description' => $product_description];
        }

        if (count($updateCols) > 0) {
            $product->update($updateCols);
        }

        return response()->json(
            [
                'data' => new ProductResource($product),
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request): JsonResponse
    {
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');

        $product = Products::create(
            [
                'name' => $product_name,
                'price' => $product_price,
                'description' => $product_description,
            ]
        );
        return response()->json(
            [
                'data' => new ProductResource($product),
            ],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Products $product): JsonResponse
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
