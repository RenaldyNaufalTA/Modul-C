<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderDetailResource;

class OrderDetailController extends Controller
{
    public function index()
    {
        $data = OrderDetail::latest()->get();
        return response()->json([OrderDetailResource::collection($data), 'OrderDetail fetched.']);
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
            'jumlahBarang' => 'required',
            'totalHarga' => 'required',
            'idOrder' => 'required',
            'idProduk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        Order::create([
            'orderDate' => date('Y-m-d', time()),
            'idCustomer' => auth()->user()->id,
            'idKirim' => $request->idKirim,
        ]);

        $OrderDetail = OrderDetail::create([
            'jumlahBarang' => $request->jumlahBarang,
            'totalHarga' => $request->totalHarga,
            'idOrder' => $request->idOrder,
            'idProduk' => $request->idProduk,
        ]);

        return response()->json(['OrderDetail created successfully.', new OrderDetailResource($OrderDetail)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $OrderDetail = OrderDetail::find($id);
        if (is_null($OrderDetail)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new OrderDetailResource($OrderDetail)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $OrderDetail)
    {
        $validator = Validator::make($request->all(), [
            'jumlahBarang' => 'required',
            'totalHarga' => 'required',
            'idOrder' => 'required',
            'idProduk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $OrderDetail->jumlahBarang = $request->jumlahBarang;
        $OrderDetail->totalHarga = $request->totalHarga;
        $OrderDetail->idOrder = $request->idOrder;
        $OrderDetail->idProduk = $request->idProduk;
        $OrderDetail->save();

        return response()->json(['OrderDetail updated successfully.', new OrderDetailResource($OrderDetail)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $OrderDetail)
    {
        $OrderDetail->delete();

        return response()->json('OrderDetail deleted successfully');
    }
}