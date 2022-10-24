<?php

namespace App\Http\Controllers\API;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::get();
        return ProdukResource::collection($products);
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
            'namaProduk' => 'required|string|max:255',
            'beratProduk' => 'required',
            'warnaProduk' => 'required|string|max:255',
            'tanggalProduksi' => 'required|date',
            'hargaProduk' => 'required',
            'idKategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $produk = Produk::create([
            'namaProduk' => $request->namaProduk,
            'beratProduk' => $request->beratProduk,
            'warnaProduk' => $request->warnaProduk,
            'tanggalProduksi' => $request->tanggalProduksi,
            'hargaProduk' => $request->hargaProduk,
            'idKategori' => $request->idKategori,
        ]);

        return response()->json(['Produk created successfully.', new ProdukResource($produk)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        if (is_null($produk)) {
            return response()->json('Data not found', 404);
        }
        return new ProdukResource($produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namaProduk' => 'required|string|max:255',
            'beratProduk' => 'required',
            'warnaProduk' => 'required|string|max:255',
            'tanggalProduksi' => 'required',
            'hargaProduk' => 'required',
            'idKategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // $produk = new Produk();
        // $produk->namaProduk = $request->namaProduk;
        // $produk->beratProduk = $request->beratProduk;
        // $produk->warnaProduk = $request->warnaProduk;
        // $produk->tanggalProduksi = $request->tanggalProduksi;
        // $produk->hargaProduk = $request->hargaProduk;
        // $produk->idKategori = $request->idKategori;
        // $produk->save();
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json(['Produk updated successfully.', new ProdukResource($produk)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::find($id)->delete();
        return response()->json('Produk deleted successfully');
    }
}