<?php

namespace App\Http\Controllers\API;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::get();
        return KategoriResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaKategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $kategori = Kategori::create([
            'namaKategori' => $request->namaKategori,
        ]);

        return response()->json(['Kategori created successfully.', new KategoriResource($kategori)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (is_null($kategori)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new KategoriResource($kategori)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(), [
            'namaKategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $kategori->namaKategori = $request->namaKategori;
        $kategori->save();

        return response()->json(['Kategori updated successfully.', new KategoriResource($kategori)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return response()->json('Kategori deleted successfully');
    }
}