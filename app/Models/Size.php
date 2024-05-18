<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];

    /* Relacion uno a Muchos */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
