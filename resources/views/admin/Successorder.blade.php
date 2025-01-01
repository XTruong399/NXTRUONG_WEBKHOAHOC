@extends('admin_layout')
@section('admin_content')

@if(session('success'))
    <div style="text-align: center;font-size: 1.4rem;">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800"></h1>

                <div class="container">
                    <h1 class="mb-4">Danh sách sản phẩm đã thanh toán thành công</h1>

                    @foreach ($orders as $order)
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Đơn hàng: {{ $order->order_number }}</strong> - 
                                <span style="color:red">Khách hàng: {{ $order->user ? $order->user->user_name : 'Không có người dùng' }}</span> - 
                                <span>Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="card-body">
                                <!-- Chỉ nên hiển thị dữ liệu cần thiết -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $detail)
                                            <tr>
                                                <td>{{ $detail->product->Pro_name ?? 'Sản phẩm không tồn tại' }}</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>{{ number_format($detail->price, 2) }} VNĐ</td>
                                                <td>{{ number_format($detail->quantity * $detail->price, 2) }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <strong>Tổng đơn hàng: {{ number_format($order->total_price, 2) }} VNĐ</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
