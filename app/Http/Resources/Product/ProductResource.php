<?php

namespace App\Http\Resources\Product;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = "product";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = Category::find($this->category_id);

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "slug" => $this->slug,
            "image" => $this->image,
            "price" => $this->price,
            "stock" => $this->stock,
            "status" => $this->status,
            "category" => [
                "id" => $category->id,
                "name" => $category->name,
                "slug" => $category->slug,
            ],

            "createdAt" => $this->created_at,
        ];

    }
}
