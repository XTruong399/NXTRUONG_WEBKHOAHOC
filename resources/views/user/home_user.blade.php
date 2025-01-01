@extends('layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Slideshow Section -->
<section style="background-color: #5624d0; width: 100%; border-radius: 1%;">
    <div class="slideshow-container">
        @foreach (['banner1.jpg', 'banner2.jpg', 'banner.jpg'] as $banner)
        <div class="mySlides slide">
            <img src="{{ asset('public/frontend/images/' . $banner) }}" style="border-radius: 5px; width: 100%;">
            <div class="text"></div>
        </div>
        @endforeach
    </div>
    <br>
</section>


<section class="trusted-by">
    <h2 style="text-align: center; margin-bottom: 3%;">Các khóa học phổ biến</h2>
    <div class="brands">
        @foreach (['logoIT.jpg', 'logoMC.jpg', 'logoKD.jpg', 'logoPT.jpg'] as $logo)
        <img src="{{ asset('public/frontend/images/logo/' . $logo) }}" alt="" style="padding-right: 20px; margin-right: 30px;">
        @endforeach
    </div>
</section>


<section class="courses" >
    <h2 style="background-color: #af30eb; border-radius: 30px; padding: 5px 0; text-align: center; margin-bottom: 50px; margin: 0 auto; justify-items: center; ">Các khóa học bán chạy nhất</h2>
    <br>
    <br>
    <div class="course-list" >
        @foreach($popularProducts as $products)
        <div class="course">
            <img src="{{ asset('public/frontend/images/html.jpg') }}" alt="AWS Course">
            <h3>{{ $products->Pro_name }}</h3>
            <p style="padding-bottom: 20px;">{{ number_format($products->price) }} VND</p>
            <div class="button-group">
            <a href="{{ route('pro_detail', $products->Pro_id) }}"class="button" style="height: 40px; width: 100%;">Xem giới thiệu </a>
            <button class="button add-to-card" style="height: 40px; width: 100%;" data-product-id="{{ $products->Pro_id }}">Thêm vào giỏ hàng</button>
           
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Course đề xuất -->
<section class="courses">
    <h2 style="background-color: #af30eb; border-radius: 30px; padding-top: 5px; margin-inline: 30px;">Các khóa học bán chạy nhất</h2>
    <br><br>
    <div class="course-list" >
        @foreach($bestsellerProducts as $products)
        <div class="course">
            <img src="{{ asset('public/frontend/images/kinhdoanh.jpg') }}" alt="AWS Course">
            <h3>{{ $products->Pro_name }}</h3>
            <p style="padding-bottom: 20px;">{{ number_format($products->price) }} VND</p>
            <div class="button-group">
            <a href="{{ route('pro_detail', $products->Pro_id) }}"class="button" style="height: 40px; width: 100%;">Xem giới thiệu </a>
            <form action="{{ route('cart.show') }}" method="POST">
    @csrf
    <input type="hidden" name="Pro_id" value="{{ $products->Pro_id }}">
    <button class="button add-to-card" style="height: 40px; width: 100%;" data-product-id="{{ $products->Pro_id }}">Thêm vào giỏ hàng</button>
</form>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Blog Section -->
<div class="row" style="margin-top: 7%; margin-left: 5%;">

    @foreach (range(1, 2) as $index)
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="well blog">
            <a href="#">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="image">
                            <img src="{{ $index === 1 ? asset('public/frontend/images/hinhnodejs.jpg')  :asset('public/frontend/images/bloghtml.jpg') }}" alt="Blog Image">
                       

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="blog-details">
                        <h2>
    {{ $index === 1 ? 'Khóa học NodeJS' : ($index === 2 ? 'Khóa học HTML' :   $index) }}
</h2>

                            <p>Các khóa học cơ bản của website</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Fixed Banner Section -->
 <div class="banner-right" style="position: fixed; top: 10%; right: 0; z-index: 10000;">
    <img src="{{ asset('public/frontend/images/banner6.jpg') }}" alt="Banner Quảng Cáo" style="width: 150px;">
</div> 

<script>
$(document).ready(function() {
    $(".add-to-card").click(function() {
        var productId = $(this).data("product-id");
        var quantity = $(this).closest('.button-group').find('input[name="quantity"]').val(); 
        console.log("ID sản phẩm:", productId);
        
        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        $.ajax({
    url: '{{ route("cart.add") }}', // Đổi thành URL mới
    method: 'POST',
    data: {
        Pro_id: productId,
        quantity: quantity,
        _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        alert(response.message);
    },
    error: function(xhr) {
        console.error(xhr.responseJSON);
        alert('Có lỗi xảy ra!');
    }
});

    });
    // Hàm tải lại các sản phẩm trong giỏ hàng
    function loadCartItems() {
        $.get('{{ route("cart.show") }}', function(data) {
            $("#cart-items").html(data);
        });
    }
});
</script>

@endsection
