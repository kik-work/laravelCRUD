<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Get all products'
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'message' => 'Get single product',
            'product_id' => $id
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Product created'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Product updated',
            'product_id' => $id
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Product deleted',
            'product_id' => $id
        ]);
    }
}
