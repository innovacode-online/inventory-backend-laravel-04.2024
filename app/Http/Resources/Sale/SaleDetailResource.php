<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "image" => $this->image,
            "price" => $this->price,
            "status" => $this->status,
            "subTotal" => $this->pivot->subTotal,
            "quantity" => $this->pivot->quantity,
        ];
    }
}
