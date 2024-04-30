<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"          => "required|unique:products,name",
            "description"   => "required",
            "image"         => "string",
            "slug"          => "string",
            "price"         => "required|numeric",
            "status"        => "boolean",
            "stock"         => "required|integer",
            "category_id"   => "required|exists:categories,id",
        ];
    }

    public function messages()
    {
        return [
            "name.required"     => "El campo nombre es obligatorio",
            "name.unique"       => "Ya se registro un producto con ese nombre",
            "description.required"  => "La descripcion es obligatoria",
            "price.required"        => "Debe agregar un precio",
            "price.numeric"         => "El precio no es valido",
            "status.boolean"        => "El tipo de datos no es valido para el estado del producto",
            "stock.required"        => "El campo stock es obligatorio",
            "stock.integer"         => "Ingrese un valor correcto para el stock",
            "category_id.required"  => "Debe asignar una categoria al producto",
            "category_id.exists"    => "La categoria asignada no existe o no se encontro",
        ];
    }
}
