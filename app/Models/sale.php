<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'names', 'lastnames', 'account_number', 'mobile_phone', 'address', 'neighborhood', 'pay'
    ];

    /* Relacion uno a muchos */
    public function sales_details()
    {
        return $this->hasMany(Sales_details::class);
    }

    /* Relacion uno a muchos */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
