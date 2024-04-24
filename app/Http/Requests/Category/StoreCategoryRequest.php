<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "name"          => "required|unique:categories,name",
            "description"   => "required",
            "image"         => "required",
            "slug"          => "",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "El campo nombre es obligatorio",
            "name.unique" => "Ya se registro una categoria con ese nombre",
            "description.required" => "La descripcion es obligatoria",
            "image.required" => "No se econtro una ruta para la imagen",
        ];
    }
}
