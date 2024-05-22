<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'color_id', 'size_id', 'product_type_id', 'season_id', 'price', 'wholesale_price', 'description', 'status', 'photo'
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
        return $this->belongsToMany(Color::class);
    }

    /* Relacion Muchos a uno */
    public function size()
    {
        return $this->belongsTo(size::class);
    }

    /* Relacion Muchos a uno */
    public function season()
    {
        return $this->belongsTo(season::class);
    }

    /* Relacion Muchos a uno */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    /* Relacion uno a uno */
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
