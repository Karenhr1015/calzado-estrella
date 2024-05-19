<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
        /* Size_id para validaciones */
        if($this->route('size')){
            $size_id = ',' . $this->route('size');
        }else{
            $size_id = '';
        }

        return [
            'value' => 'required|unique:sizes,value' . $size_id
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'El campo talla es obligatorio.',
            'value.unique' => 'Esta talla ya ha sido agregada.'
        ];
    }
}
