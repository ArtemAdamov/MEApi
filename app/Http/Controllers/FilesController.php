<?php

namespace App\Http\Controllers;

use App\Models\File;
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
        ]);

        $file = File::create($validated);

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
