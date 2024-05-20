<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];

    /* Mutadores */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = strtolower($value);
                return  ucwords($value);
            }
        );
    }

    /* Relacion uno a Muchos */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
