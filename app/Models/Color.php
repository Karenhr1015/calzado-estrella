<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color', 'color_hex', 'status'
    ];

    /* Mutadores */
    protected function color(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = strtolower($value);
                return  ucwords($value);
            }
        );
    }

    /* Relacion Muchos a Muchos */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
