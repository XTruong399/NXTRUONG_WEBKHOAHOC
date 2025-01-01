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
        <h2>Đăng Nhập</h2>
          <form action="{{URL::to('/login')}}" method="post">
          {{csrf_field ()}}
            <div class="form-group">
              <label for="email">Nhập Email</label>
              <input type="email"  name="email" >
            </div>
            <div class="form-group">
              <label for="password">Mật khẩu</label>
              <input type="password"  name="password" >
            </div>
            <div class="form-group">
              <input type="checkbox" id="newsletter" name="newsletter">
              <label>Đồng ý với các điều khoản và chính sách</label>
            </div>
            <button type="submit" class="button" style="margin-left: 40%;">Đăng Nhập</button>
          </form>
          <div class="login-link">
            <p>Bạn đã chưa có tài khoản ? <a href="#">Đăng ký</a></p>
          </div>
        </div>
      </div>
      </div>
@endsection