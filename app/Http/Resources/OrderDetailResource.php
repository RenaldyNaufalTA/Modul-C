<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jumlahBarang' => $this->jumlahBarang,
            'totalHarga' => $this->totalHarga,
            'idOrder' => $this->idOrder,
            'idProduk' => $this->idProduk,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}