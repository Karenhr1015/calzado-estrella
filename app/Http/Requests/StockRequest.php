<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockRequest extends FormRequest
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
        $stockId = $this->route('stock') ? $this->route('stock') : null;

        return [
            /* 'product_id' => [
                Rule::unique('stocks', 'product_id')->ignore($stockId)
            ] */
            'product_id' => [
                'required',
                'exists:products,id',
                Rule::unique('stocks', 'product_id')->ignore($stockId),
            ],
            // 'product_id' => 'unique:stocks,product_id' . ($stockId ? ",{$stockId}" : ""),
            'amount' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'product_id.unique' => 'El producto ya existe en el inventario.',
            'product_id.exists' => 'El producto seleccionado no existe.',
        ];
    }
}
