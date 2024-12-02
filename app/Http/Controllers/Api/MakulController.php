<?php

namespace App\Http\Controllers\Api;

use App\Models\Makul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MakulController extends Controller
{
    public function read()
    {
        $makul = Makul::all();
        return response()->json($makul, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'sks' => 'required|integer|max:20|',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $makul = Makul::create([
            'nama' => $request->nama,
            'sks' => $request->sks,
        ]);
        return response()->json([
            'messsage' => 'Makul Berhasil Dibuat',
            'data' => $makul,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $makul = Makul::findOrFail($id);
        $validator = $request->validate([
            'nama' => 'required|string|max:100',
            'sks' => 'required|integer|max:20|',
        ]);
        $makul->update($validator);

        return response()->json([
            'message' => 'Data Berhasil di update',
            'data' => $makul
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $makul = Makul::findOrFail($id);
        $makul->delete();

        return response()->json(['message' => 'Mata Kuliah deleted'], 200);
    }
}
