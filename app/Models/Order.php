<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id','order_id');
    }
    
    public function scopeCompleted($query)
    {
        return $query->where('status', 'Complete'); // Điều kiện lọc đơn hàng đã hoàn tất
    }
    public function getTotalPriceAttribute()
    {
        return $this->orderDetails->sum('total_price'); // Tính tổng giá trị đơn hàng từ OrderDetail
    }
}
