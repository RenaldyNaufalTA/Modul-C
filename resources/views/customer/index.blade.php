<div class="jumbotron">
    <div class="container">
        <h1 class="m-0">Welcome To Geek Bot!</h1>
        <p class="ms-1">Check out our latest product that might be what you need for your next project in our product
            gallery</p>
    </div>
</div>
<div class="view">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col bg-light p-3" id="shop">
                <h2 class="mt-2 fw-bold">Geek Bot Shop</h2>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <hr class="bg-info border-2 border-top border-info mt-0">
                <div class="row">

                    <div style="overflow-y: scroll; height:400px;">
                        @foreach ($produks as $produk)
                            <div class="card items mb-2 ms-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-lg-4 pt-3">
                                            <h3><strong><span class="idproduk">{{ $produk->id }}</span> - <span
                                                        class="namabarang">{{ $produk->namaProduk }}</span></strong>
                                            </h3>
                                            {{ $produk->beratProduk }} / {{ $produk->warnaProduk }} /
                                            {{ $produk->tanggalProduksi }}
                                        </div>
                                        <div style="font-size: 20px;" class="col-md-4 col-sm-4 col-lg-4 pt-2">
                                            @Rp. <span class="harga_produk">{{ $produk->hargaProduk }}</span>
                                            <br>{{ $produk->kategori->namaKategori }}
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2 pt-2">
                                            <input type="number" name="jumlahbarang" value=0 onchange="multiply(this)"
                                                autocomplete="off" min=0>
                                            <h4 class="mt-2"><strong>Rp. <span class="harga">0</span> </strong>
                                            </h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="bg-info border-2 border-top border-info">
                <h2 class="mb-2 fw-bold">Paket Pengiriman</h2>
                <div class="row">
                    <div class="col-lg-2 pt-2">
                        <p class="h6">Pilih paket</p>
                    </div>
                    <div class="col-lg-2 offset-lg-1 d-inline-flex">
                        <select class="form-select" name="kirim" id="kirim" onchange="paket(this)"
                            autocomplete="off" required>
                            @foreach ($kirims as $kirim)
                                <option value="{{ $kirim->hargaPaket }},{{ $kirim->id }}">
                                    {{ $kirim->namaPaket }}</option>
                                {{-- <input type="hidden" name="idKirim" id="idKirim" value="{{ $kirim->id }}"> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end">
                        <p class="h2">Rp.<span class="paket harga">0</span></p>
                    </div>
                </div>
                <hr class="bg-info border-2 border-top border-info">
                <div class="text-end my-3">
                    <p class="h2">Total Harga : Rp. <span class="total" id="total">0</span> </p>
                </div>
                <div class="text-center">
                    <button onclick="Cart()" class="btn btn-success submit">Submit</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="ModalEditor" class="modal">

    <!-- Modal content -->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-light">List Barang</h4>
                <button type="button" class="btn-close close"></button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga total</th>
                            </tr>
                        </thead>
                        <tbody class="listbarang">

                        </tbody>
                    </table>
                </div>
                <h4>Biaya Paket Pengiriman : Rp. <span class="paket">0</span> </h4>
                <h5>Total Harga : Rp. <span class="total">0</span> </h5>
                Buy?
                <div class="listinput">

                </div>
                <form action="/dashboard/store" method="post">
                    @csrf
                    <input type="hidden" name="idproduk[]">
                    <input type="hidden" name="namaproduk[]">
                    <input type="hidden" name="jumlahproduk[]">
                    <input type="hidden" name="hargaproduk[]">
                    <input type="hidden" name="hargakirim">
                    <input type="hidden" name="totalHarga">
                    <input type="hidden" name="idCustomer" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="orderDate" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="idKirim" value="1">
                    <input type="submit" name="Yes" value="Yes" class="btn btn-primary btn-rounded">
                    <input type="button" class="cancel" name="No" value="No"
                        class="btn btn-primary btn-rounded">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(".submit").click(function(event) {
            event.preventDefault();
        });

        function TotHar() {
            var har = $("span.harga");
            // console.log( $(har[1]).text() );
            var all = 0;
            var harga;
            for (var i = 0; i < har.length; i++) {
                harga = parseInt($(har[i]).html());
                all += harga;
            }

            $(".total").html(all);
            $("input[name*='totalHarga']").val($('.total').val());

        }

        function multiply(select) {
            var qty = $(select).val();
            price = $(select).parent().prev().children(".harga_produk").html();

            $(select).next().find(".harga").html(price * qty);

            $(select).next().val(price * qty);

            TotHar();

        }

        function paket(select) {

            var result = $('#kirim').val().split(',')[1];
            // alert(select);
            $(".paket").html($('#kirim').val().split(',')[0]);
            $("input[name*='idKirim']").val($('#kirim').val().split(',')[1]);

            TotHar();
        }



        // Get the modal
        var modal = document.getElementById('ModalEditor');


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var cancel = document.getElementsByClassName("cancel")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";

        }
        cancel.onclick = function() {
            modal.style.display = "none";

        }



        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        //$( "input[name*='kode']" ).val( "has man in it!" );
        /*$(".clickable").click(
          function () {
            $( "input[name*='kode']" ).val( "has man in it!" );
            modal.style.display = "block";
          }

          );
        */
        //kode,barang,jumlah,unit,harga,disc
        var idproduk = [],
            namaproduk = [],
            jumlahproduk = [],
            hargaproduk = [];

        function Cart() {

            var idlist = 0;
            $("tbody.listbarang").html("");
            $(".listinput").html("");
            $(".items").children(".card-body").each(function(index) {
                if ($(this).find(".harga").html() > 0) {
                    idproduk[idlist] = $(this).find(".idproduk").html();
                    namaproduk[idlist] = $(this).find(".namabarang").html();
                    jumlahproduk[idlist] = $(this).find("input[name*='jumlahbarang']").val();
                    hargaproduk[idlist] = $(this).find(".harga").html();
                    idlist++;


                    $("tbody.listbarang").append(
                        $("<tr>").append(
                            "<td>" + $(this).find(".idproduk").html() + "</td>" +
                            "<td>" + $(this).find(".namabarang").html() + "</td>" +
                            "<td>" + $(this).find("input[name*='jumlahbarang']").val() + "</td>" +
                            "<td>" + $(this).find(".harga").html() + "</td>"
                        )
                    )


                }

                $("input[name*='hargakirim']").val($(".paket").html());
                $("input[name*='totalHarga']").val($(".total").html());


                $("input[name*='idproduk']").val(idproduk);
                $("input[name*='namaproduk']").val(namaproduk);
                $("input[name*='jumlahproduk']").val(jumlahproduk);
                $("input[name*='hargaproduk']").val(hargaproduk);

                // $("input[name*='idproduk']").val(JSON.stringify(idproduk));
                // $("input[name*='namaproduk']").val(JSON.stringify(namaproduk));
                // $("input[name*='jumlahproduk']").val(JSON.stringify(jumlahproduk));
                // $("input[name*='hargaproduk']").val(JSON.stringify(hargaproduk));


            })


            //console.log(idproduk);
            //console.log(namaproduk);
            modal.style.display = "block";
        }
    </script>
@endsection
