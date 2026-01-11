<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // Get all smartphones
    public function index()
    {
        return Smartphone::all();
    }

    // Get a single smartphone
    public function show($id)
    {
        return Smartphone::findOrFail($id);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
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
