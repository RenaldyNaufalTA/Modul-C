<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::latest()->get();
        return response()->json([OrderResource::collection($data), 'Order fetched.']);
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
            'idCustomer' => 'required',
            'idKirim' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $Order = Order::create([
            'orderDate' => date('Y-m-d', time()),
            'idCustomer' => $request->idCustomer,
            'idKirim' => $request->idKirim,
        ]);

        return response()->json(['Order created successfully.', new OrderResource($Order)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Order = Order::find($id);
        if (is_null($Order)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new OrderResource($Order)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $Order)
    {
        $validator = Validator::make($request->all(), [
            'idCustomer' => 'required',
            'idKirim' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $Order->orderDate = date('Y-m-d', time());
        $Order->idCustomer = $request->idCustomer;
        $Order->idKirim = $request->idKirim;
        $Order->save();

        return response()->json(['Order updated successfully.', new OrderResource($Order)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $Order)
    {
        $Order->delete();

        return response()->json('Order deleted successfully');
    }
}