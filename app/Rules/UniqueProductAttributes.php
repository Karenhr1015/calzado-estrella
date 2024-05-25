<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueProductAttributes implements Rule
{
    protected $productId;

    public function __construct($productId = null)
    {
        $this->productId = $productId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exists = DB::table('products')
            ->where('name', request('name'))
            ->where('season_id', request('season_id'))
            ->when($this->productId, function ($query) {
                return $query->where('id', '!=', $this->productId);
            })
            ->exists();

        return !$exists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe un producto con los mismos atributos.';
    }
}

