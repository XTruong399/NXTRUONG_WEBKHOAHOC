<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register');
    }
    public function handleRegister(Request $request)
    {
        // Validation dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'name' => 'required|max:255',
        ]);

        // Nếu có lỗi validation
        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Mã hóa mật khẩu và lưu thông tin người dùng
        $user = new User();
        $user->user_name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'student'; // Mã hóa mật khẩu
        $user->save();

        // Đăng nhập người dùng ngay sau khi đăng ký thành công
        auth()->login($user);

        // Chuyển hướng tới trang chủ
        return redirect()->route('login');
    }
    

    


}
