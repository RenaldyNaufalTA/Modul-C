<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = ['order_details'];
    protected $guarded = ['id'];

    // protected $casts = [
    //     'jumlahBarang' => 'array',
    //     'totalHarga' => 'array',
    //     'idProduk' => 'array',
    // ];
}