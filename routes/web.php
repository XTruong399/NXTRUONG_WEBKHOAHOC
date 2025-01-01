<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trangchu', [HomeController::class, 'index']);
// Route::get('/shoppingcart', [HomeController::class, 'shoppingcart']);
Route::get('/category/{id}', [HomeController::class, 'showByCategory'])->name('category.products');




// Route xử lý đăng nhập
Route::post('/login', [Admincontroller::class, 'handleLogin']);
// Route hiển thị trang đăng nhập
Route::get('/login', [Admincontroller::class, 'login'])->name('login');
// Route hiển thị dashboard (sau khi đăng nhập)
Route::get('/admin_dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
//QLNhanvien
Route::get('/Qlstaff', [Admincontroller::class, 'Qlstaff'])->name('Qlstaff');
Route::get('/Successorder', [Admincontroller::class, 'Successorder'])->name('Successorder');
//Trang cho user
Route::get('/home_user', [UserController::class, 'home_user'])->name('home_user');
//Route đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Điều hướng tới trang login sau khi logout
})->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route để xử lý form đăng ký
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.handle');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

// Route Sửa admin
Route::get('/admin/edit/{admin_id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update/{admin_id}', [AdminController::class, 'update'])->name('admin.update');

// Route Xóa admin
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admins.delete');;
// Đăng xuất
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/product_detail/{Pro_id}', [UserController::class, 'pro_detail'])->name('pro_detail');
Route::get('/product_detail/{Pro_id}', [HomeController::class, 'pro_detail'])->name('pro_detail');



//Giỏ hàng
Route::post('/cartadd', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/shopping-cart', [CartController::class, 'shoppingcart'])->name('cart.show');
Route::post('/shopping-cart', [CartController::class, 'shoppingcart'])->name('cart.show');
//xóa sp
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::get('/home_user', [HomeController::class, 'index'])->name('home_user');
Route::get('/trangchu', [HomeController::class, 'guestHome'])->name('trangchu');
Route::post('/checkout/{userId}', [OrderController::class, 'checkout'])->name('checkout');

Route::prefix('admin')->group(function () {
Route::get('/products', [AdminController::class, 'productIndex'])->name('admin.products.index');
Route::get('/products/create', [AdminController::class, 'productCreate'])->name('admin.products.create');
Route::post('/products/store', [AdminController::class, 'productStore'])->name('products.store');
Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])->name('admin.products.edit');
Route::put('/products/{product}', [AdminController::class, 'productUpdate'])->name('admin.products.update');

Route::delete('/products/{product}', [AdminController::class, 'productDestroy'])->name('admin.products.destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/my-courses', [UserController::class, 'my_courses'])->name('my_courses');
    Route::get('/course/{Pro_id}', [UserController::class, 'pro_detail'])->name('pro_detail');
});





});