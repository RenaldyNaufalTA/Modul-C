<?php

namespace App\Http\Controllers\API;

use App\Models\Kirim;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KirimResource;
use Illuminate\Support\Facades\Validator;

class KirimController extends Controller
{
    public function index()
    {
        $data = Kirim::get();
        return KirimResource::collection($data);
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
            'namaPaket' => 'required|string|max:255',
            'hargaPaket' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $Kirim = Kirim::create([
            'namaPaket' => $request->namaPaket,
            'hargaPaket' => $request->hargaPaket,
        ]);

        return response()->json(['Paket created successfully.', new KirimResource($Kirim)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Kirim = Kirim::find($id);
        if (is_null($Kirim)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new KirimResource($Kirim)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kirim $Kirim)
    {
        $validator = Validator::make($request->all(), [
            'namaPaket' => 'required|string|max:255',
            'hargaPaket' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $Kirim->namaPaket = $request->namaPaket;
        $Kirim->hargaPaket = $request->hargaPaket;
        $Kirim->save();

        return response()->json(['Paket updated successfully.', new KirimResource($Kirim)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kirim $Kirim)
    {
        $Kirim->delete();

        return response()->json('Paket deleted successfully');
    }
}