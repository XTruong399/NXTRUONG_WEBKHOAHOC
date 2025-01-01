@extends('layout')
@section('content')
@if(session('error'))
        <div style="text-align: center;font-size: 1.4rem;">
        <div class="alert alert-success">
            {{ session('error') }}
            <a href="#" class="alert-link"> Đăng ký ngay!</a>
        </div>
        </div>
            @endif
<div style="margin-top: 10%;margin-bottom: 20%;">
<div class="container">
        <div class="form-container">
        <h2>Đăng ký tài khoản</h2>
          <form action="{{ route('register.handle') }}" method="post">
          {{csrf_field ()}}
          <div class="form-group">
              <label for="email">Nhập họ và tên học viên</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" required>
              @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            </div>
            <div class="form-group">
              <label for="email">Nhập Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required>
              @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            </div>
            <div class="form-group">
              <label for="email">Nhập số điện thoại</label>
              <input type="phone" id="phone" name="phone" value="{{ old('phone') }}" required>

            </div>
            <div class="form-group">
              <label for="password">Nhập mật khẩu</label>
              <input type="password" id="password" name="password" required>
              @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
            </div>
            <div>
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div style="color: red;">{{ $message }}</div>
            @enderror

        </div>
            <div class="form-group">
              <input type="checkbox" id="newsletter" name="newsletter">
              <label>Đồng ý với các điều khoản và chính sách</label>
            </div>
            <button type="submit" class="button" style="margin-left: 40%;">Đăng ký</button>
          </form>
          <div class="login-link">
            <p>Bạn đã có tài khoản ? <a href="#">Đăng nhập</a></p>
          </div>
        </div>
      </div>
      </div>
@endsection