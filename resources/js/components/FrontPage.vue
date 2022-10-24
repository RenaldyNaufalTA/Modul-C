<template>
    <div class="row justify-content-center m-0" style="height:100%;" >
        <div class="col-sm-1 pt-5 pe-0">
            <div class="px-2 pt-3 pb-2" style="background:#002350;">
                <h2 class="text-light ms-1">Manage Product</h2>
            </div>
        </div>
        <div class="col-lg-9 bg-light p-3 me-5 mh-100 fs-5">
            <div class="px-3">
                <div class="d-flex bd-highlight">
                    <h2 class="mt-4 flex-grow-1 bd-highlight fw-bold">Product</h2>
                    <button data-bs-toggle="modal" data-bs-target="#addProduct"
                        class="mt-0 bd-highlight btn btn-primary align-self-center">Add Product</button>

                </div>
                <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert" v-show="successDelete">Deleted Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <hr class="bg-info border-2 border-top border-info">
                <div class="table-responsive">
                    <table class="table border-less" cellspacing="0">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Berat</th>
                                <th>Warna</th>
                                <th>Tanggal Produk</th>
                                <th>Harga Produk</th>
                                <th>Kategori</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="product in products" v-bind:key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.namaProduk }}</td>
                                    <td>{{ product.beratProduk }}</td>
                                    <td>{{ product.warnaProduk }}</td>
                                    <td>{{ product.tanggalProduksi }}</td>
                                    <td>{{ product.hargaProduk }}</td>
                                    <td>{{ product.idKategori.namaKategori }}</td>
                                    <td>
                                        <b-button size="md" v-b-modal="'myModal'" @click="editProduct(product)" class="btn btn-success">Edit
                                        </b-button>
                                        <button type="button" @click="deleteProduct(product.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-3">
                <div class="d-flex bd-highlight">
                    <h2 class="mt-4 flex-grow-1 bd-highlight fw-bold">Category</h2>
                    <button data-bs-toggle="modal" data-bs-target="#addCategory" class="mt-0 bd-highlight btn btn-primary align-self-center">Add Category</button>

                </div>
                <hr class="bg-info border-2 border-top border-info">
                <div class="table-responsive">
                    <table class="table border-less" width="100%" cellspacing="0">
                        <tbody>
                                <tr v-for="category in categories" v-bind:key="category.id">
                                    <td>{{ category.namaKategori }}</td>
                                    <td>
                                        <button type="button" @click="deleteCategory(category.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade modal-lg" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addProduct">
                            <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert" v-show="successCreate">Product Created Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>
                            <div class="px-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="namaProduk" id="namaProduk" v-model="produk.namaProduk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Berat Produk</label>
                                    <input type="text" class="form-control" name="beratProduk" id="beratProduk" v-model="produk.beratProduk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Warna Produk</label>
                                    <input type="text" class="form-control" name="warnaProduk"
                                        id="warnaProduk" v-model="produk.warnaProduk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Tanggal Produksi</label>
                                    <input type="date" class="form-control" name="tanggalProduksi" id="tanggalProduksi" v-model="produk.tanggalProduksi">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control" name="hargaProduk" id="hargaProduk" v-model="produk.hargaProduk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                                    <select class="form-select" name="idKategori" id="idKategori" v-model="produk.idKategori">
                                        <option v-for="category in categories" v-bind:key="category.id"
                                            :value="category.id">{{ category.namaKategori }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <b-modal id="myModal" hide-footer size="lg" title="Edit Product" hide-backdrop header-class="card-header-modal">
            <form @submit.prevent="updateProduct(product.id)">
                <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert" v-show="successUpdate">Product Updated Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="px-3">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="namaProduk" id="namaProduk" v-model="product.namaProduk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Berat Produk</label>
                        <input type="text" class="form-control" name="beratProduk" id="beratProduk" v-model="product.beratProduk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Warna Produk</label>
                        <input type="text" class="form-control" name="warnaProduk"
                            id="warnaProduk" v-model="product.warnaProduk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tanggal Produksi</label>
                        <input type="date" class="form-control" name="tanggalProduksi" id="tanggalProduksi" v-model="product.tanggalProduksi">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" name="hargaProduk" id="hargaProduk" v-model="product.hargaProduk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                        <select class="form-select" name="idKategori" id="idKategori" v-model="product.idKategori">
                            <option v-for="category in categories" v-bind:key="category.id"
                                :value="category.id" :selected="category.id == 1">{{ category.namaKategori }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </b-modal>
        <div class="modal fade modal-lg" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addCategory">
                            <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert" v-show="successCreate">Category Created Successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div class="px-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="namaKategori" id="namaKategori" v-model="category.namaKategori">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                categories: [],
                product: {
                    id:'',
                    namaProduk:'',
                    beratProduk: '',
                    warnaProduk: '',
                    tanggalProduksi: '',
                    hargaProduk: '',
                    idKategori: '',
                },
                produk: {
                    id:'',
                    namaProduk:'',
                    beratProduk: '',
                    warnaProduk: '',
                    tanggalProduksi: '',
                    hargaProduk: '',
                    idKategori: '',
                },
                category: {
                    id:'',
                    namaKategori:'',
                },

                successCreate: false,
                successUpdate: false,
                successDelete: false,

            };
        },

        mounted() {
            this.getProducts();
            this.getCategories();
        },

        methods: {
            // Product
                getProducts: function(){
                    axios.get('/api/products')
                    .then((response) => {
                        this.products = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },

                addProduct: function(){

                    fetch('/api/products/store', {
                    method: 'post',
                    body: JSON.stringify(this.produk),
                    headers: {
                        'content-type': 'application/json'
                    }
                    })
                    .then((response) => {
                        this.products = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    // axios.post('/api/products/store', this.produk).then(response => {
                    //     this.produk = {};
                    //     this.successCreate = true;
                    // }).catch(error => {
                    //     conslo.log('Error')
                    // });
                    setTimeout(this.getProducts(), 1000);
                    setTimeout(this.successCreate = true, 3000);

                },

                editProduct(product) {
                    this.update = true;
                    this.product.id = product.id;
                    this.product.product_id = product.id;
                    this.product.namaProduk = product.namaProduk;
                    this.product.beratProduk = product.beratProduk;
                    this.product.warnaProduk = product.warnaProduk;
                    this.product.tanggalProduksi = product.tanggalProduksi;
                    this.product.hargaProduk = product.hargaProduk;
                    this.product.idKategori = product.idKategori;
                },
                updateProduct: function(id) {
                    fetch('/api/products/update/' + id, {
                        method: 'post',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then((response) => {
                        this.products = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    // axios.post('/api/products/update/' + id, this.product).then(response => {
                    //     this.product = {};
                    //     this.successUpdate = true;
                    // }).catch(error => {
                    //     conslo.log('Error')
                    // });
                    setTimeout(this.getProducts(), 1000);
                    setTimeout(this.successUpdate = true, 1000);
                },

                deleteProduct: function(id) {
                    if (confirm("Do you really want to delete it?")) {
                    fetch('/api/products/' + id, {
                        method: 'post'
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.getProducts();
                        })
                        .catch(err => console.log(err));
                        setTimeout(this.successDelete = true, 3000);

                    }
                },
                clearForm() {
                    this.product.id = null;
                    this.product.namaProduk = '';
                    this.product.beratProduk = '';
                    this.product.warnaProduk = '';
                    this.product.tanggalProduksi = '';
                    this.product.hargaProduk = null;
                    this.product.idKategori = '';
                },

                // Category
                getCategories: function(){
                    axios.get('/api/categories')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },

                addCategory: function(){
                    fetch('/api/categories/store', {
                    method: 'post',
                    body: JSON.stringify(this.category),
                    headers: {
                        'content-type': 'application/json'
                    }
                    })
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .then(data => {
                            this.getCategories();
                        })
                    .catch(function (error) {
                        console.log(error);
                    });
                    setTimeout(this.getCategories(), 1000);
                    setTimeout(this.successCreate = true, 3000);
                },
                deleteCategory: function(id) {
                    if (confirm("Do you really want to delete it?")) {
                    fetch('/api/categories/' + id, {
                        method: 'post'
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.getCategories();
                        })
                        .catch(err => console.log(err));
                        setTimeout(this.successDelete = true, 3000);

                    }
                },

            }

    };
</script>
