<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Str;



class Admincontroller extends Controller
{
    public function login()
    {
        
        return view('admin.login');
    } 
    public function Successorder()
    {
        $orders = Order::with('user', 'orderDetails.product') 
        ->where('status', 'Complete')
        ->get();

       
        return view('admin.Successorder',compact('orders'));
    }
    public function handleLogin(Request $request)
    { 
        $user = DB::table('users')->where('email', $request->email)->first();
        session(['user_name' => $user->user_name]);
        // Kiểm tra nếu người dùng không tồn tại
        if (!$user) {
            session()->flash('error', 'Người dùng không tồn tại!');
            return back();
        }
    
        // Kiểm tra mật khẩu
        if (!Hash::check($request->password, $user->password)) {
            session()->flash('error', 'Mật khẩu không đúng!');
            return back();
        }
    
        // Nếu kiểm tra mật khẩu đúng
        Auth::loginUsingId($user->user_id);
    
        // Kiểm tra vai trò của người dùng
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if ($user->role === 'user') {
            return redirect()->route('home_user');
        }
    
        return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không đúng!']);
    }

//Hiển thị dashboard
public function showDashboard(Request $request)
{
    // Kiểm tra xem có thông tin admin trong session không
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('user'));
        } else {
            return $this->redirectToDashboard($user);
        }
    }

    return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
}
protected function redirectToDashboard($user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'user') {
        return redirect()->route('home');
    } else {
        return redirect()->route('login')->with('error', 'Vai trò không hợp lệ!');
    }
}
/////
public function Qlstaff()
{
    $admins = DB::table('admins')->get();
    return view('admin.qlstaff', compact('admins'));
}
//form thêm DL
public function create()
{
    return view('admin.create');
}

// Lưu thông tin Thêm admin vào DB
public function store(Request $request)
{
    DB::table('admins')->insert([
        'admin_name' => $request->admin_name,
        'admin_email' => $request->admin_email,
        'admin_password' => $request->input('admin_password'),
        'admin_phone' => $request->admin_email,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.create')->with('success', 'Thêm admin thành công!');
}

// Hiển thị form sửa thông tin Admin
public function edit($admin_id)
{
    $admin = DB::table('admins')->where('admin_id', $admin_id)->first();
    return view('admin.edit', compact('admin'));
}


public function update(Request $request, $admin_id)
{
    DB::table('admins')->where('admin_id', $admin_id)->update([
        'admin_name' => $request->admin_name,
        'admin_email' => $request->admin_email,
        'updated_at' => now()
    ]);

    return redirect()->route('admins.index')->with('success', 'Cập nhật thông tin thành công!');
}


public function destroy($id)

{
    if ($id == 1) {
        return redirect()->route('Qlstaff')->with('error', 'Không thể xóa tài khoản admin mặc định!');
    }
    DB::table('admins')->where('admin_id', $id)->delete();
    return redirect()->route('Qlstaff')->with('success', 'Xóa thông tin thành công!');
}
public function logout(Request $request)
{   
    Auth::logout();
    // Xóa tất cả thông tin trong session
    session()->forget('cart');
    session()->flush();

    // Chuyển hướng đến trang đăng nhập
    return redirect()->route('home')->with('success', 'Bạn đã đăng xuất thành công!');
}
public function productIndex()
{
    $products = Product::all();
    return view('admin.products.index', compact('products'));
}
public function productCreate()
{
    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
}
public function productStore(Request $request)
{
    $validatedData = $request->validate([
        'Pro_name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'cate_id' => 'required|integer|exists:categories,cate_id',
    ]);
    $slug = $request->slug ?: Str::slug($request->Pro_name);
    try {
        Product::create([
            'Pro_name' => $request->Pro_name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'cate_id' => $request->cate_id,
            'bestseller' => false,
            'popular' =>false,
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}



public function productEdit(Product $product)
{
    $categories = Category::all();
    
    // Truyền cả biến $product và $categories vào view
    return view('admin.products.edit', compact('product', 'categories'));
}

// Cập nhật sản phẩm
public function productUpdate(Request $request, Product $product)
{
    // Xác thực dữ liệu nhập vào
    $validatedData = $request->validate([
        'Pro_name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'cate_id' => 'required|exists:categories,cate_id',
    ]);
    try {
        $product->update($validatedData);
        $product->refresh();  // Lấy dữ liệu mới nhất từ cơ sở dữ liệu
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}


// Xóa sản phẩm
public function productDestroy(Product $product)
{
    try {
        // Xóa sản phẩm
        $product->delete();

        // Quay lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    } catch (\Exception $e) {
        // Xử lý lỗi nếu có
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}

}
