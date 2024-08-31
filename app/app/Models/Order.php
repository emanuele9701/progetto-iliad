<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order_date',
        'total_value',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_order');
    }
}
