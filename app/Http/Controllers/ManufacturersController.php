<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::orderBy($request->sortby ?: 'name', $request->sortdesc ?: 'asc')
            ->paginate($request->per_page ?: 10);

        return response()->json(['data' => $manufacturers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $manufacturer = Manufacturer::create($validated);

        return response()->json(['data' => $manufacturer], 201);
    }

    public function show(Manufacturer $manufacturer)
    {
        return response()->json(['data' => $manufacturer]);
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $manufacturer->update($validated);

        return response()->json(['data' => $manufacturer]);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json(null, 204);
    }
}
