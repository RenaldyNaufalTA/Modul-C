@extends('layouts.main')
@section('content')
@section('class', 'body')
<div class="view">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col bg-light p-3">
                <div class="row main">
                    <h1>{{ auth()->user()->nama }}</h1>
                    <br><br><br><br>
                    <h2>Shopping History</h2>
                    <div class="row history">

                        <div class="scroll-history" style="overflow-y: scroll; height:500px;">
                            @foreach ($orders as $order)
                                <div class="card my-2 ms-5">
                                    <div class="card-body">
                                        <h1>{{ $order->orderDate->format('D M j Y') }} - Paket
                                            {{ $order->kirim->namaPaket }} :
                                            {{ $order->kirim->hargaPaket }}</h1>
                                        <h3 class="order">Order detail</h3>
                                        <div class="table-responsive fs-5">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="listbarang">
                                                    @foreach ($order->produk->unique('id') as $produk)
                                                        <tr>

                                                            <td>{{ $produk->id }}</td>
                                                            <td>{{ $produk->namaProduk }}</td>

                                                            <td>{{ $produk->pivot->jumlahBarang }}</td>

                                                            <td>{{ $produk->hargaProduk }}</td>
                                                            {{-- @foreach ($order->produk->unique('namaProduk') as $name) --}}
                                                            {{-- <td>{{ $produk->namaProduk }}</td> --}}
                                                            {{-- @endforeach --}}
                                                            {{-- @foreach ($order->produk->unique('pivot.jumlahBarang') as $jumlah) --}}
                                                            {{-- <td>{{ $produk->jumlahBarang }}</td> --}}
                                                            {{-- @endforeach --}}
                                                            {{-- @foreach ($order->produk->unique('hargaProduk') as $harga) --}}
                                                            {{-- <td>{{ $produk->hargaProduk }}</td> --}}
                                                            {{-- @endforeach --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <h1>Harga Total :
                                                {{ $order->produk->unique('pivot.totalHarga')->sum('pivot.totalHarga') }}
                                            </h1>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
