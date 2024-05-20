<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
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
        if ($this->route('season')) {
            $season_id = ',' . $this->route('season');
        } else {
            $season_id = '';
        }

        return [
            'name' => 'required|unique:seasons,name' . $season_id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo temporada es obligatorio.',
            'name.unique' => 'Este temporada ya ha sido agregada.',
        ];
    }
}
