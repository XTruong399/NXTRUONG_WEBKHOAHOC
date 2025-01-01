<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'Pro_id'; 
    public $incrementing = false;    // Nếu Pro_id không phải số tự động tăng
    protected $keyType = 'string'; 
    // Các cột có thể được gán giá trị
    // Model Product
// Model Product
public function carts()
{
    return $this->hasMany(Cart::class, 'Pro_id');
}
public function orderDetails()
{
    return $this->hasMany(OrderDetail::class, 'Pro_id', 'Pro_id');
}


    protected $fillable = [
        'Pro_name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'cate_id',
        'bestseller',
        'popular',
        'created_at',
        'updated_at'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id'); 
    }
}
