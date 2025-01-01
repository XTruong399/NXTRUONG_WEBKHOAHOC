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
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"></h1>
            <p class="mb-4"><a target="_blank"
                    href="https://datatables.net"></a>.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách tài khoản admin</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="{{ route('admin.create') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
                        </form>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Password</th>
                                    <th>Ngày tạo</th>
                                    <th>Chức vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->admin_name }}</td>
                                    <td>{{ $admin->admin_email }}</td>
                                    <td>{{ $admin->admin_phone }}</td>
                                    <td>{{ $admin->admin_password }}</td>
                                    <td>{{ $admin->created_at }}</td>
                                    <td>Nhân viên</td>
                                    
                                    <td>
                                    <form action="{{ route('admins.delete', $admin->admin_id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                    {{csrf_field ()}}
                                     @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
</div>
<!-- End of Content Wrapper -->

</div>
@endsection