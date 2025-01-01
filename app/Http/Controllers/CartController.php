<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $userId = Auth::id(); 
            $productId = $request->input('Pro_id'); 
            $quantity = $request->input('quantity', 1); 
            if ($userId) {
                $cartItem = Cart::where('user_id', $userId)->where('Pro_id', $productId)->first();
        
                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => $userId,
                        'Pro_id' => $productId,
                        'quantity' => $quantity
                    ]);
                }
            } else {
                
                $cartId = session()->getId();  
                $cart = session()->get('cart_' . $cartId, []); 
        
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantity;
                } else {
                    $product = Product::findOrFail($productId);
                    $cart[$productId] = [
                        'name' => $product->Pro_name,
                        'price' => $product->price,
                        'quantity' => $quantity
                    ];
                }
        
                // Lưu giỏ hàng vào session với session id
                session()->put('cart_' . $cartId, $cart);
            }
        
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.'], 500);
        }
        
    }

    public function shoppingcart()
    {
        $userId = Auth::id();
    
        // Kiểm tra xem có giỏ hàng trong session không
        if ($userId) {
            // Lấy giỏ hàng từ cơ sở dữ liệu
            $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        } else {
            // Lấy giỏ hàng từ session
            $cartItems = session('cart', []);
        }
    
        // Tính tổng giá trị giỏ hàng
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if (isset($item['price'])) { // Đối với session
                $totalPrice += $item['price'] * $item['quantity'];
            } else { // Đối với cơ sở dữ liệu
                $totalPrice += $item->product->price * $item->quantity;
            }
        }
    
        return view('pages.shoppingcart', compact('cartItems', 'totalPrice'));
    }
    public function removeFromCart(Request $request)
    {
        try {
            // Lấy ID sản phẩm cần xóa
            $productId = $request->input('Pro_id') ?? $request->input('product_id');
    
            // Kiểm tra người dùng đã đăng nhập hay chưa
            if (Auth::check()) {
                // Nếu đã đăng nhập, xóa sản phẩm khỏi cơ sở dữ liệu
                $userId = Auth::id();
                Cart::where('user_id', $userId)->where('Pro_id', $productId)->delete();
            } else {
                // Nếu chưa đăng nhập, xóa sản phẩm khỏi session
                $cart = session('cart', []);
                if (isset($cart[$productId])) {
                    unset($cart[$productId]);
                    session()->put('cart', $cart);  // Lưu lại giỏ hàng đã cập nhật vào session
                }
            }
            return redirect()->route('cart.show');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra khi xóa sản phẩm.'], 500);
        }
        
    }
}
