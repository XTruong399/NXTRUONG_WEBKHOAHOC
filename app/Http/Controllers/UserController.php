<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; 

class UserController extends Controller
{
    public function home_user()
    {
        $bestsellerProducts = Product::where('bestseller', 1)->get();
        $popularProducts = Product::where('popular', 1)->get();
       return view('user.home_user', [
        'bestsellerProducts' => $bestsellerProducts,
        'popularProducts' => $popularProducts
    ]); 
    }
    public function pro_detail($Pro_id)
{
    $product = Product::find($Pro_id);
    if (!$product) {
        abort(404, 'Sản phẩm không tồn tại.');
    }
    return view('pages.pro_detail', compact('products'));
}
public function my_courses()
{ 
    $userId = Auth::id(); 
        $orders = Order::where('user_id', $userId) 
                        ->with('orderDetails.product') 
                        ->get();
        if ($orders->isEmpty()) {
            return view('user.my_courses', ['message' => 'Không có đơn hàng nào.']);
        }
    return view('user.my_courses', compact('orders'));
}

}
