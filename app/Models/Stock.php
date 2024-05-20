<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'amount', 'status'];

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

    /* Relacion uno a uno */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
