<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            /* names */
            'names' => 'required',
            /* lastnames */
            'lastnames' => 'required',
            /* account_number */
            'account_number' => 'required',
            /* address */
            'address' => 'required',
            /* neighborhood */
            'neighborhood' => 'required',
            /* mobile_phone */
            'mobile_phone' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            /* names */
            'names.required' => 'El campo nombres es obligatorio.',
            /* lastnames */
            'lastnames.required' => 'El campo apellidos es obligatorio.',
            /* account_number */
            'account_number.required' => 'El campo numero de cuenta o telefono es obligatorio.',
            /* address */
            'address.required' => 'El campo direccion es obligatorio.',
            /* neighborhood */
            'neighborhood.required' => 'El campo barrio es obligatorio.'
        ];
    }
}
