<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'Pro_id',
        'quantity',
        'price',
        'total_price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'Pro_id', 'Pro_id');
    }
    public function order()
{
    return $this->belongsTo(Order::class, 'order_id');
}

}
