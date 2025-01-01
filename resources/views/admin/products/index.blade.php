@if(session('success'))
        <div style="text-align: center; font-size: 1.4rem;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@extends('admin_layout')
@section('admin_content')
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
           

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Quản lý sản phẩm</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Slug</th>
                                        <th>Giá</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Tồn kho</th>
                                        <th>Danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->Pro_name }}</td>
                                            <td>{{ $product->slug }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount_price ?? 'Không' }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if($product->category)
                                                {{ $product->category->cate_name }}
                                                                    @else
                                                    <span>Không có danh mục</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                          <!-- sửa xóa -->
                                          <td>
                        <!-- Nút sửa -->
                        <a href="{{ route('admin.products.edit', $product->Pro_id) }}" class="btn btn-warning">Sửa</a>
            <!-- Nút xóa -->
                        <form action="{{ route('admin.products.destroy', $product->Pro_id) }}" method="POST" style="display:inline;">
                         @csrf
                            @method('DELETE')  <!-- Xác nhận hành động DELETE -->
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                Xóa
                        </button>
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
