<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'total_price', 'sale_id', 'product_id', 'size_id', 'color_id'
    ];

    /* Relacion Muchos a uno */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


    /* Relacion uno a muchos */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /* Relacion uno a muchos */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    /* Relacion uno a muchos */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
