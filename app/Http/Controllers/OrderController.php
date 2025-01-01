<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail; 

class OrderController extends Controller
{
    public function checkout(Request $request, $userId)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }
        try {
            $cartItems = Cart::where('user_id', $userId)->get();
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Giỏ hàng trống!');
            }
            
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
            
            // Đảm bảo có giá trị user_name khi tạo đơn hàng
            $userName = auth()->user() ? auth()->user()->user_name : 'Không có tên người dùng';
            
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => 'Complete',
                'user_name' => $userName, // Gán user_name vào đơn hàng
            ]);
    
            // Lưu chi tiết đơn hàng
            foreach ($cartItems as $item) {
                $orderDetail = new OrderDetail([
                    'order_id' => $order->id,
                    'Pro_id' => $item->Pro_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'user_name' => auth()->user()->user_name, 
                    'total_price' => $item->quantity * $item->product->price,
                ]);
    
                $orderDetail->save();
            }
    
            // Xóa sản phẩm trong giỏ hàng
            Cart::where('user_id', $userId)->delete();
    
            return redirect()->route('cart.show')->with('success', 'Thanh toán thành công! Đơn hàng đã được tạo.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    
}
