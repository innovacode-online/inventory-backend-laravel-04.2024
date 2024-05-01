<?php

namespace App\Http\Resources\Sale;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public static $wrap = "sale";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $user = User::find($this->user_id);
        $products = Sale::find($this->id)->products;

        return [
            "id" => $this->id,
            "clientName" => $this->client_name,
            "clientLastname" => $this->client_lastname,
            "user" => $user,
            "products" => new SaleDetailCollection( $products ),
            // "products" => $products,
            'createdAt' => $this->created_at
        ];
    }
}
