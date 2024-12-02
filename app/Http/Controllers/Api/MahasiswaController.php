<?php

namespace App\Http\Controllers\Api;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function read()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:mahasiswas',
            'prodi' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
        ]);
        return response()->json([
            'messsage' => 'Mahasiswa Berhasil Dibuat',
            'data' => $mahasiswa,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim,' . $id,
            'prodi' => 'required|string',
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($validator);

        return response()->json([
            'message' => 'Data Berhasil di update',
            'data' => $mahasiswa
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa deleted'], 200);
    }
}
