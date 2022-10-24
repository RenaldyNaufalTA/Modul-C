<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'produks' => Produk::all(),
            'kategoris' => Kategori::all(),
            'kirims' => Kirim::all(),
        ]);
    }

    public function store(Request $request)
    {
        $idproduk = $request->input('idproduk')[0];
        $produkId = explode(',', $idproduk);

        $hargaproduk = $request->input('hargaproduk')[0];
        $hproduk = explode(',', $hargaproduk);

        $jumlahproduk = $request->input('jumlahproduk')[0];
        $jproduk = explode(',', $jumlahproduk);
        $order = Order::create([
            'orderDate' => $request->orderDate,
            'idCustomer' => $request->idCustomer,
            'idKirim' => $request->idKirim,
        ]);
        foreach ($produkId as $key => $item) {
            OrderDetail::create([
                'jumlahBarang' => $jproduk[$key],
                'totalHarga'   => $hproduk[$key],
                'idOrder'      => $order->id,
                'idProduk'     => $produkId[$key],
            ]);
        }

        // foreach ($produkId as $item) {
        //     foreach ($produkId as $item) {
        //         foreach ($produkId as $item) {
        //             OrderDetail::create([
        //                 'jumlahBarang' => $jproduk[$key],
        //                 'totalHarga'   => $hproduk[$key],
        //                 'idOrder'      => $order->id,
        //                 'idProduk'     => $produkId[$key],
        //             ]);
        //         }
        //     }
        // }


        return redirect('/dashboard')->with('success', 'Pembelian Berhasil');
    }
}