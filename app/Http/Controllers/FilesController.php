<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $files = File::orderBy($request->sortby ?: 'filename', $request->sortdesc ?: 'asc')
            ->paginate($request->per_page ?: 10);

        return response()->json(['data' => $files]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filename' => 'required',
            'path' => 'required',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
        ]);

        $file = File::create($validated);

        if ($request->has('supplier_id')) {
            $supplier = Supplier::find($request->supplier_id);
            $file->supplier()->associate($supplier);
            $file->save();
        }

        if ($request->has('manufacturer_id')) {
            $manufacturer = Manufacturer::find($request->manufacturer_id);
            $file->manufacturer()->associate($manufacturer);
            $file->save();
        }

        return response()->json(['data' => $file], 201);
    }

    public function show(File $file)
    {
        return response()->json(['data' => $file]);
    }

    public function update(Request $request, File $file)
    {
        $validated = $request->validate([
            'filename' => 'required',
            'path' => 'required',
        ]);

        $file->update($validated);

        return response()->json(['data' => $file]);
    }

    public function destroy(File $file)
    {
        $file->delete();

        return response()->json(null, 204);
    }
}
