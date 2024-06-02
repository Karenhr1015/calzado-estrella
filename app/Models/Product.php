<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'product_type_id', 'price', 'wholesale_price', 'description', 'status', 'amount', 'photo', 'photo_sizes'
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

    /* Relacion Muchos a Muchos */
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('img_path')->withTimestamps();
    }


    /* Relacion Muchos a Muchos */
    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withTimestamps();
    }

    /* Relacion Muchos a Muchos */
    public function seasons()
    {
        return $this->belongsToMany(Season::class)->withTimestamps();
    }

    /* Relacion Muchos a uno */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }
}
