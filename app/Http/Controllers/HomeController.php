<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function guestHome()
    {
        return view('pages.home', [
            'bestsellerProducts' => Product::where('bestseller', 1)->get(),
            'popularProducts' => Product::where('popular', 1)->get()
        ]);
    }
        public function index()
        {
            if (auth()->check()) {
                $bestsellerProducts = Product::where('bestseller', 1)->get();
                $popularProducts = Product::where('popular', 1)->get();
    
                // Trả về trang home_user và truyền dữ liệu
                return view('user.home_user', [
                    'bestsellerProducts' => $bestsellerProducts,
                    'popularProducts' => $popularProducts
                ]);
            } else {
                // Nếu chưa đăng nhập, chuyển hướng tới trang chủ thông thường
                return view('pages.home', [
                    'bestsellerProducts' => Product::where('bestseller', 1)->get(),
                    'popularProducts' => Product::where('popular', 1)->get()
                ]);
            }
        }
        public function showByCategory($cate_id)
        {
            $category = Category::findOrFail($cate_id);
            $products = Product::where('cate_id', $cate_id)->paginate(10); 
            return view('pages.Category', compact('category', 'products'));
        }
        public function pro_detail($Pro_id)
        {
            $product = Product::find($Pro_id);

        
            // Kiểm tra nếu sản phẩm không tồn tại
            if (!$product) {
                abort(404, 'Sản phẩm không tồn tại.');
            }
        
            // Trả về view với dữ liệu sản phẩm
            return view('pages.pro_detail', compact('product'));
        }
  
}

