<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function read()
    {
        $dosens = Dosen::all();
        return response()->json($dosens, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:20|unique:dosens',
            'fakultas' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $dosens = Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'fakultas' => $request->fakultas,
        ]);
        return response()->json([
            'messsage' => 'Dosen Berhasil Dibuat',
            'data' => $dosens,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $dosens = Dosen::findOrFail($id);
        $dosens->update($request->all());

        return response()->json([
            'message' => 'Data Berhasil di ambil',
            'data' => $dosens
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $dosens = Dosen::findOrFail($id);
        $dosens->delete();

        return response()->json(['message' => 'Dosen deleted'], 200);
    }
}
