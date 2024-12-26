<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lokasi::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $lokasi = Lokasi::create($request->all());
        return response()->json($lokasi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return response()->json($lokasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());
        return response()->json($lokasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();
        return response()->json(null, 204);
    }
}
