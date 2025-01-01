<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGDEMY</title>
    <link  href="{{asset('public/frontend/css/cart.css')}}" rel="stylesheet">
    <link  href="{{asset('public/frontend/css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />

</head>
<body>
    <header class="navbar">
        <div class="logo">TGDEMY</div>
        <nav>
          <ul class="menu">
            <li><a href="{{URL::to('/trangchu')}}">Trang chủ</a></li>
            <li><a href="{{URL::to('/admin.create')}}">Phát triển</a></li>
            <li><a href="#">Kinh doanh</a></li>
            <li><a href="#">CNTT & Phần mềm</a></li>
            <li><a href="#">Năng suất văn phòng</a></li>
          </ul>
        </nav>
        <div class="auth-buttons">
        @if(Auth::check())
        <p>Xin chào, {{ session('user_name') }}!</p>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Đăng xuất</button>
    <button type="button" class="btn btn-default btn-md" onclick="window.location.href='{{ URL::to('/shoppingcart') }}'">
            <span class="glyphicon glyphicon-shopping-cart">
            </span>
            <b> Giỏ hàng </b>
        </button>
        <form action="{{ route('my_courses') }}" method="GET">
        <button type="submit" class="btn btn-primary">Khóa học của tôi</button>
    </form>
</form>
@else
<button class="btn btn-default btn-md"  onclick="window.location.href='{{ URL::to('/login') }}'">Đăng nhập</button>
<button class="btn btn-default btn-md" onclick="window.location.href='{{ URL::to('/singup') }}'">Đăng ký</button>
<button type="button" class="btn btn-default btn-md" onclick="window.location.href='{{ URL::to('/shoppingcart') }}'">
            <span class="glyphicon glyphicon-shopping-cart">
            </span>
            <b> Giỏ hàng </b>
        </button>
@endif
        </div>
      </header>

      @yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">TGDEMY</div>
                <p>© 2024 TGdemy, Inc.</p>
            </div>
            <div class="col-md-2">
                <h4>Udemy Business</h4>
                <ul>
                    <li>Giải pháp doanh nghiệp</li>
                    <li>Tài khoản doanh nghiệp</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>Nghề nghiệp</h4>
                <ul>
                    <li>Blog</li>
                    <li>Tư vấn sự nghiệp</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>Điều khoản</h4>
                <ul>
                    <li>Chính sách quyền riêng tư</li>
                    <li>Cài đặt cookie</li>
                    <li>Sơ đồ trang web</li>
                    <li>Tuyên bố về khả năng tiếp cận</li>
                </ul>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-primary btn-sm">Tiếng Việt</a>
            </div>
        </div>
    </div>
    <p style="text-align: center;">@SV Thực hiện:Nguyễn Xuân Trường-2200003563</p>
</footer>
</body>
<script src="{{asset(path: 'public/frontend/js/java.js')}}"></script>
<script>document.querySelectorAll('.button').forEach(button => {

let div = document.createElement('div'),
    letters = button.textContent.trim().split('');

function elements(letter, index, array) {

    let element = document.createElement('span'),
        part = (index >= array.length / 2) ? -1 : 1,
        position = (index >= array.length / 2) ? array.length / 2 - index + (array.length / 2 - 1) : index,
        move = position / (array.length / 2),
        rotate = 1 - move;

    element.innerHTML = !letter.trim() ? '&nbsp;' : letter;
    element.style.setProperty('--move', move);
    element.style.setProperty('--rotate', rotate);
    element.style.setProperty('--part', part);

    div.appendChild(element);

}

letters.forEach(elements);

button.innerHTML = div.outerHTML;

button.addEventListener('mouseenter', e => {
    if(!button.classList.contains('out')) {
        button.classList.add('in');
    }
});

button.addEventListener('mouseleave', e => {
    if(button.classList.contains('in')) {
        button.classList.add('out');
        setTimeout(() => button.classList.remove('in', 'out'), 950);
    }
});

});
</script>
</html>