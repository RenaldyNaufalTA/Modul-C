<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}