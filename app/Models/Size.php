<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'status'
    ];

    /* Mutadores */
    protected function value(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return  strtoupper($value);
            }
        );
    }

    /* Relacion uno a Muchos */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
