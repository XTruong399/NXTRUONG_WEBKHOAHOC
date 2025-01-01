@extends('layout')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    .container {
        display: flex;
        flex-direction: row;
        margin: 20px auto;
        max-width: 1200px;
    }

    .sidebar {
        width: 20%;
        padding: 10px;
        background-color: #fff;
        border-right: 1px solid #ddd;
    }

    .main {
        width: 80%;
        padding: 20px;
        background-color: #fff;
    }

    .order-item {
        border: 1px solid #ddd;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 5px;
        background-color: #fff;
    }

    .order-item h3 {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .order-item p {
        font-size: 0.9em;
        margin-bottom: 10px;
        color: #555;
    }

    .order-details ul {
        list-style: none;
        padding: 0;
    }

    .order-details li {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .order-details li:last-child {
        border-bottom: none;
    }

    .product-name {
        font-weight: bold;
        font-size: 1.1em;
        margin-bottom: 5px;
    }

    .price {
        font-size: 0.9em;
        color: #d9534f;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="sidebar">
        <div class="filter-group">
            <label>Rating</label>
            <input type="checkbox"> 4.5+<br>
            <input type="checkbox"> 4.0+<br>
            <input type="checkbox"> 3.5+<br>
            <input type="checkbox"> 3.0+<br>
        </div>
        <div class="filter-group">
            <label>Video Duration</label>
            <input type="checkbox"> 0-1 hours<br>
            <input type="checkbox"> 1-3 hours<br>
            <input type="checkbox"> 3-6 hours<br>
            <input type="checkbox"> 6-17 hours<br>
        </div>
    </div>
    <div class="main">
        <h1>Danh sách khóa học của tôi</h1>
        @if(isset($orders) && $orders->count() > 0)
            @foreach($orders as $order)
                <div class="order-item">
                    <p>Tổng giá trị: {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                    <p>Trạng thái: {{ $order->status }}</p>
                    <p>Ngày tạo: {{ $order->created_at }}</p>
                    <div class="course-card-custom">
                        <ul>
                            @foreach($order->orderDetails as $orderDetail)
                                <li>
                                <img src="{{ asset('public/frontend/images/html.jpg') }}" alt="AWS Course">
                                    <div class="product-name">{{ $orderDetail->product->Pro_name ?? 'Sản phẩm không tồn tại' }}</div>
                                    <p>Số lượng: {{ $orderDetail->quantity }}</p>
                                    <p class="price">Giá: {{ number_format($orderDetail->price, 0, ',', '.') }} VND</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @else
            <p>Không có đơn hàng nào.</p>
        @endif
    </div>
</div>
@endsection
