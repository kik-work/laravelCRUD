<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products,
        ], 200);
    }

    public function show($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => "Product with ID {$product_id} not found",
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Product with ID {$product_id} retrieved successfully",
            'data' => $product
        ], 200);
    }


    public function store(Request $request)
    {
        $product_validation = $request->validate(
            [
                'product_name' => 'required|string|max:255 ',
                'product_description' => 'nullable|string|max:255 ',
                'product_SKU' => 'required|string|max:100|unique:products,product_SKU',
                'product_quantity' => 'required|integer|min:0',
                'product_price' => 'required|decimal:0,2|min:0 ',
            ]
        );
        $product = Product::create($product_validation);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $product_id)
    {
        $product_validation = $request->validate(
            [
                'product_name' => 'required|string|max:255 ',
                'product_description' => 'nullable|string|max:255 ',
                'product_SKU' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('products', 'product_SKU')->ignore($product_id, 'product_id'),
                ],
                'product_quantity' => 'required|integer|min:0',
                'product_price' => 'required|decimal:0,2|min:0 ',
            ]
        );
        $product = Product::findOrFail($product_id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => "Product with ID {$product_id} not found",
                'data' => null
            ], 404);
        }
        $product->update($product_validation);

        return response()->json([
            'success' => true,
            'message' => "Product ID {$product_id} updated successfully",
            'data' => $product
        ], 201);
    }
   

    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
         
        $product-> destroy($product_id);
        return response()->json([
            'message' => 'Product deleted',
            'product_id' => $product_id
        ]);
    }
}
