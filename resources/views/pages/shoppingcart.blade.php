@if(session('success'))
        <div style="text-align: center;font-size: 1.4rem;">
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="#" class="alert-link"></a>
        </div>
        </div>
    @endif

@extends('layout')
@section('content')
<link  href="{{ asset('public/frontend/css/cart.css') }}" rel="stylesheet">
<div class="cart-container">
    <h1>Giỏ hàng</h1>

    @if(Auth::check())
        @php
            $userId = Auth::id();
            $cartItems = App\Models\Cart::with('product')->where('user_id', $userId)->get();
        @endphp

        @if(count($cartItems) > 0)
            <h3>{{ count($cartItems) }} khóa học trong giỏ hàng</h3>
            <table style="padding:10px 15px;">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr style="padding:10px 15px;">
                            <td style="padding-right: 100px;" >{{ $item->product->Pro_name }}</td> 
                            <td style="padding-right: 100px;">{{ number_format($item->product->price) }} VND</td>  
                            <td style="padding-right: 300px;">{{ $item->quantity }}</td>  
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="Pro_id" value="{{ $item->Pro_id }}">
                                    <button type="submit" class="remove-item button alternative">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Giỏ hàng của bạn trống.</p>
        @endif
    @else
        @php
            $cartItems = session('cart', []);
        @endphp

        @if(count($cartItems) > 0)
            <h3>{{ count($cartItems) }} khóa học trong giỏ hàng</h3>
            @foreach($cartItems as $productId => $item)
                <div class="cart-item" >
                    <h3 >{{ $item['name'] }}</h3>  <!-- Tên sản phẩm -->
                    <p>{{ number_format($item['price']) }} VND</p>  <!-- Giá sản phẩm -->
                    <p>Số lượng: {{ $item['quantity'] }}</p>  <!-- Số lượng sản phẩm -->
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productId }}">
                        <button type="submit" class="remove-item button alternative">Xóa</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>Giỏ hàng của bạn trống.</p>
        @endif
    @endif
    <div class="total-section">
        <h3>Tổng: <span>{{ number_format($totalPrice) }} VND</span></h3>
        @if(Auth::check())
            <form action="{{ route('checkout', ['userId' => auth()->id()]) }}" method="POST">
                @csrf
                <button type="submit" class="button alternative">Thanh toán</button>
            </form>
        @else
            <!-- Người dùng chưa đăng nhập -->
            <a href="{{ route('login') }}" class="btn btn-warning">Vui lòng đăng nhập để thanh toán</a>
        @endif
        <div class="coupon">
            <input type="text" placeholder="Nhập coupon">
            <button>Áp dụng</button>
        </div>
    </div>

</div>

<!-- Recommended Courses -->
<div class="recommend-section">
    <h2>Bạn cũng có thể thích</h2>
    <div class="course-list">
        <div class="course-card">
            <img src="{{ asset('public/frontend/images/html.jpg') }}" alt="DevOps Course">
            <h3>DevOps on AWS for Beginner</h3>
            <p>₫ 1.499.000</p>
        </div>
        <div class="course-card">
            <img src="{{ asset('public/frontend/images/html.jpg') }}" alt="Microservices">
            <h3>Thực chiến microservice với Spring Boot</h3>
            <p>₫ 1.149.000</p>
        </div>
    </div>
</div>

@endsection
