<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueProductAttributes;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        /* Season_id para validaciones */
        $productId = $this->route('product') ? $this->route('product') : null;

        $rules = [
            /* name */
            'name' => ['required', new UniqueProductAttributes($productId)],
            /* code */
            'code' => [
                'nullable',
                Rule::unique('products', 'code')->ignore($productId)->where(function ($query) {
                    return $query->whereNotNull('code');
                })
            ],
            /* price */
            'price' => 'required|numeric|min:0',
            /* wholesale_price */
            'wholesale_price' => 'required|numeric|min:0',
            /* product_type_id */
            'product_type_id' => 'required|exists:product_types,id',
            /* description */
            'description' => 'nullable|string',
            /* cantidad */
            'amount' => 'required|numeric|min:0',
            /* photo */
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        if ($this->isMethod('POST')) {
            $rules['color_ids'] = [
                'required',
                'array',
                'min:1',
                Rule::exists('colors', 'id'),
            ];
            $rules['sizes_ids'] = [
                'required',
                'array',
                'min:1',
                Rule::exists('sizes', 'id'),
            ];
            $rules['seasons_ids'] = [
                'required',
                'array',
                'min:1',
                Rule::exists('seasons', 'id'),
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            /* name */
            'name.required' => 'El campo referencia es obligatorio.',
            /* Colors */
            'color_ids.required' => 'Seleccione al menos un color.',
            'color_ids.array' => 'Los colores seleccionados deben estar en formato de array.',
            'color_ids.min' => 'Seleccione al menos un color.',
            /* price */
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser numérico.',
            'price.min' => 'El precio debe ser mayor o igual a :min.',
            /* wholesale_price */
            'wholesale_price.required' => 'El precio mayorista es obligatorio.',
            'wholesale_price.numeric' => 'El precio mayorista debe ser numérico.',
            'wholesale_price.min' => 'El precio mayorista debe ser mayor o igual a :min.',
            /* Sizes */
            'sizes_ids.required' => 'Seleccione al menos una talla.',
            'sizes_ids.array' => 'Las tallas seleccionadas deben estar en formato de array.',
            'sizes_ids.min' => 'Seleccione al menos una talla.',
            /* Seasons */
            'seasons_ids.required' => 'Seleccione al menos una temporada.',
            'seasons_ids.array' => 'Las temporadas seleccionadas deben estar en formato de array.',
            'seasons_ids.min' => 'Seleccione al menos una temporada.',
            /* product_type_id */
            'product_type_id.required' => 'El tipo de producto es obligatorio.',
            'product_type_id.exists' => 'El tipo de producto seleccionado no es válido.',
            /* description */
            'description.string' => 'La descripción debe ser una cadena de caracteres.',
            /* Cantidad */
            'amount.required' => 'La cantidad es obligatoria.',
            'amount.numeric' => 'La cantidad debe ser numérica.',
            'amount.min' => 'La cantidad debe ser mayor o igual a :min.',
            /* photo */
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'La imagen debe ser de tipo: :values.',
            'photo.max' => 'La imagen no debe ser mayor de :max KB.',
        ];
    }
}
