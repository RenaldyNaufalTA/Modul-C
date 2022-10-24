<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['kategori'];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idKategori');
    }

    public function kirim()
    {
        return $this->hasOne(Kirim::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'idProduk', 'idOrder');
    }
}
