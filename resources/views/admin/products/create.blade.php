@if(session('success'))
        <div style="text-align: center; font-size: 1.4rem;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
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
        <!-- Form thêm sản phẩm -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        {{csrf_field ()}}

            <div class="mb-3">
                <label for="pro_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="pro_name" name="Pro_name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="discount_price" class="form-label">Giá giảm (nếu có)</label>
                <input type="number" class="form-control" id="discount_price" name="discount_price" step="0.01">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Số lượng tồn kho</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>

            <select class="form-control" id="cate_id" name="cate_id" required>
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                <option value="{{ $category->cate_id }}">{{ $category->cate_name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </div>
</div>
@endsection
