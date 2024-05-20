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
        /* if ($this->route('product')) {
            $product_id = ',' . $this->route('product');
        } else {
            $product_id = '';
        }
 */
        /* Season_id para validaciones */
        $productId = $this->route('product') ? $this->route('product') : null;

        return [
            'name' => ['required', new UniqueProductAttributes($productId)],
            'code' => [
                'nullable',
                Rule::unique('products', 'code')->ignore($productId)->where(function ($query) {
                    return $query->whereNotNull('code');
                })
            ],
            'price' => 'required|integer|min:0',
            'wholesale_price' => 'required|integer|min:0',
            'color_id' => 'exists:colors,id',
            'size_id' => 'exists:sizes,id',
            'season_id' => 'exists:seasons,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo referencia es obligatorio.',
            'wholesale_price.required' => 'El campo precio mayorista es obligatorio.',
            'code.unique' => 'El codigo ya existe.',
            'color_id.exists' => 'El color seleccionado no existe.',
            'size_id.exists' => 'La talla seleccionada no existe.',
            'season_id.exists' => 'La temporada seleccionada no existe.',
        ];
    }
}
