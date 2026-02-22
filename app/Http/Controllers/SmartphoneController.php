<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // Get all smartphones with pagination & filters
    public function index(Request $request)
    {
        $query = Smartphone::with('user');

        // 🔎 Filtering
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('ram')) {
            $query->where('ram', $request->ram);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // 📄 Pagination (default 10 per page)
        $perPage = $request->get('per_page', 5);
        $smartphones = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Phones data retrieved successfully',
            'data' => $smartphones->items(),
            'pagination' => [
                'current_page' => $smartphones->currentPage(),
                'last_page' => $smartphones->lastPage(),
                'per_page' => $smartphones->perPage(),
                'total' => $smartphones->total(),
            ]
        ], 200);
    }

    // Get a single smartphone
    public function show($id)
    {
        return Smartphone::findOrFail($id);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'ram' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $smartphone = Smartphone::create($validated);



        return response()->json($smartphone, 201);
    }


    // Update a smartphone
    public function update(Request $request, $id)
    {
        $smartphone = Smartphone::findOrFail($id);
        if (!$smartphone) {
            return response()->json(['message' => 'Smartphone not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'brand' => 'sometimes|string|max:255',
            'ram' => 'sometimes|integer',   // ✅ integer
            'price' => 'sometimes|numeric',
        ]);


        $smartphone->update($validated);
        return response()->json($smartphone);
    }

    // Delete a smartphone
    public function destroy($id)
    {
        $smartphone = Smartphone::find($id);

        if (!$smartphone) {
            return response()->json(['message' => 'Smartphone not found'], 404);
        }

        $smartphone->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
