<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['orderDate'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idCustomer');
    }

    public function kirim()
    {
        return $this->belongsTo(Kirim::class, 'idKirim');
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'order_details', 'idOrder', 'idProduk')->distinct()->withPivot(['jumlahBarang', 'totalHarga']);
    }
}