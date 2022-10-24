<template>
    <div class="view">
        <form action="#" method="post">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col bg-light p-3" id="shop">
                        <h2 class="mt-2 fw-bold">Geek Bot Shop</h2>
                        <hr class="bg-info border-2 border-top border-info mt-0">
                        <div class="row">
                            <div style="overflow-y: scroll; height:400px;">
                                    <div class="card items mb-2 ms-5" v-for="product in products" v-bind:key="product.id">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col pt-3">
                                                    <h4 class="fw-bold">{{ product.id }} - {{ product.namaProduk }}</h4>
                                                    <p class="mb-0">{{ product.beratProduk }}
                                                        (berat)
                                                        / {{ product.warnaProduk }} / {{ product.tanggalProduksi }}</p>
                                                </div>
                                                <div class="col pt-2">
                                                    <h4>@Rp. <span class="harga_produk">{{ product.hargaProduk }}</span></h4>
                                                    <h4>{{ product.idKategori.namaKategori }}</h4>
                                                </div>
                                                <div class="col pt-2">
                                                    <input type="number" name="jumlahbarang" value=0
                                                         autocomplete="off" min=0 @change="multiply()">
                                                    <h4 class="mt-2"><strong>Rp. <span class="harga" id="harga">0</span> </strong>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <hr class="bg-info border-2 border-top border-info">
                        <h2 class="mb-2 fw-bold">Paket Pengiriman</h2>
                        <div class="row">
                            <div class="col-lg-2 pt-2">
                                <p class="h6">Pilih paket</p>
                            </div>
                            <div class="col-lg-2 offset-lg-1 d-inline-flex">
                                <select class="form-select form-select-sm" name="paket" id="paket" @change="paket(this)">

                                    <option v-for="kirim in kirims" v-bind:key="kirim.id"
                                    :value="kirim.hargaPaket">{{ kirim.namaPaket }}</option>

                                </select>
                            </div>
                            <div class="text-end">
                                <p class="h2">Rp.<span class="paket">0</span></p>
                            </div>
                        </div>
                        <hr class="bg-info border-2 border-top border-info">
                        <div class="text-end my-3">
                            <p class="h2">Total Harga : Rp. <span class="total" id="total">0</span> </p>
                        </div>
                        <div class="text-center">

                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
import { BButton, BModal, VBModal } from "bootstrap-vue";
    export default {
        components: {
            BButton,
            BModal,
        },
        directives: {
            'b-modal': VBModal
        },
        data() {
            return {
                products: [],
                kirims: [],
            }

        },
        mounted(){
            this.getProducts();
            this.getKirims();
            // this.multiply(this);
            // this.paket(this);
            this.TotHar();
        },

        methods: {
                getProducts: function(){
                    axios.get('/api/products')
                    .then((response) => {
                        this.products = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },
                getKirims: function(){
                    axios.get('/api/kirims')
                    .then((response) => {
                        this.kirims = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },
                // TotHar: function(){
                //     var har = $("span.harga");
                // // console.log( $(har[1]).text() );
                //     var all = 0;
                //     var harga;
                //     for (var i = 0; i < har.length; i++) {
                //     harga =  $(har[i]).html() ;
                //     all+= harga;
                //     }

                //     $(".total").html( all );
                // },
                // multiply: function(this) {
                //     var qty = $(this).val();
                //     var price = $(this).parent().prev().children(".harga_produk").html();

                //     $(this).next().find(".harga").html(price * qty);

                //     $(this).next().val(price*qty);

                //     TotHar();

                // },
                // paket: function(this){
                //     $(".paket").html($(this).val());

                //     TotHar();
                // },

                TotHar: function() {
                    let har = document.getElementById("harga");
                    let all = 0;
                    let harga;
                    // for (let i = 0; i < har.length; i++) {
                    //     harga = parseInt( $(har[i]).innerHTML );
                    //     all+= harga;
                    // }
                    document.getElementById("total").innerHTML =  " HeLLO" ;
                },
                multiply() {
                    // let qty = select.value;
                    // price = select.parent().previousElementSibling.children(".harga_produk").innerHTML;
                    // select.nextElementSibling.find(".harga").innerHTML = price * qty;
                    // select.nextElementSibling.val(price*qty);
                    TotHar();
                },
                // paket: function(select){
                //     document.getElementByClassName("paket").innerHTML = select.value;
                //     TotHar();
                // },

        },



    }
</script>
