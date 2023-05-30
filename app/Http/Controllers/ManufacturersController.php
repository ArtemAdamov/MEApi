<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::with('suppliers')->orderBy($request->sortby ?: 'name', $request->sortdesc ?: 'asc')
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
        $manufacturer->load('files');
        // TODO: extract to another ENDPOINT and controller
        $suppliers = DB::table('supplier_manufacturer')
            ->where('manufacturer_id', $manufacturer->id)
            ->pluck('supplier_id');
        $manufacturer->suppliers = Manufacturer::find($suppliers);
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
