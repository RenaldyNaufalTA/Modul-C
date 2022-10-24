<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'orderDate' => $this->orderDate,
            'idCustomer' => $this->idCustomer,
            'idKirim' => $this->idKirim,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}