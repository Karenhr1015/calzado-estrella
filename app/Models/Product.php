<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'color_id', 'size_id', 'season_id', 'price', 'status'
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

    /* Relacion Muchos a uno */
    public function color()
    {
        return $this->belongsTo(Color::class);
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
}
