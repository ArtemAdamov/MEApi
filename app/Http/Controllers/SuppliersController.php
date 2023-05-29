<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy($request->sortby ?: 'name', $request->sortdesc ?: 'asc')
            ->paginate($request->per_page ?: 10);

        return response()->json(['data' => $suppliers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'addresses' => 'required|array',
            'addresses.*.type' => 'required|in:actual,legal',
            'addresses.*.address' => 'required',
        ]);

        $supplier = Supplier::create($validated);

        return response()->json(['data' => $supplier], 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json(['data' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required',
            'addresses' => 'required|array',
            'addresses.*.type' => 'required|in:actual,legal',
            'addresses.*.address' => 'required',
        ]);

        $supplier->update($validated);

        return response()->json(['data' => $supplier]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(null, 204);
    }
}
