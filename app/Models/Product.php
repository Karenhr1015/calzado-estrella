<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'color_id', 'size_id', 'season_id', 'price'
    ];

    /* Relacion Muchos a uno */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(size::class);
    }

    public function season()
    {
        return $this->belongsTo(season::class);
    }

}
