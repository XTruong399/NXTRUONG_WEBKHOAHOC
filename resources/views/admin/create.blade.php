@extends('admin_layout')
@section('admin_content')
<div class="card-body">
                    <div class="table-responsive">
                    @if(session('success'))
        <div style="text-align: center;font-size: 1.4rem;">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        </div>
            @endif
                        <form action="{{ route('admin.store') }}" method="post">
                        {{csrf_field ()}}
                        <div class="mb-3">
            <label for="admin_name" class="form-label">Tên tài khoản Admin</label>
            <input type="text" class="form-control" id="admin_name" name="admin_name" required>
        </div>

        <div class="mb-3">
            <label for="admin_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="admin_email" name="admin_email" required>
        </div>

        <div class="mb-3">
            <label for="admin_password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="admin_password" name="admin_password" required>
        </div>
        <div class="mb-3">
            <label for="admin_password" class="form-label">Số điện thoại</label>
            <input type="phone" class="form-control" id="admin_phone" name="admin_phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                        </div>
                    </div>

@endsection