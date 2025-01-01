@extends('admin_layout')
@section('admin_content')
<div class="card-body">
    <!-- Form sửa sản phẩm -->
    <form action="{{ route('admin.products.update', $product->Pro_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Đảm bảo phương thức PUT được sử dụng để cập nhật -->

        <div class="mb-3">
            <label for="Pro_name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="Pro_name" name="Pro_name" value="{{ old('Pro_name', $product->Pro_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="discount_price" class="form-label">Giá giảm (nếu có)</label>
            <input type="number" class="form-control" id="discount_price" name="discount_price" step="0.01" value="{{ old('discount_price', $product->discount_price) }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng tồn kho</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="cate_id" class="form-label">Danh mục</label>
            <select class="form-control" id="cate_id" name="cate_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->cate_id }}" {{ $category->cate_id == $product->cate_id ? 'selected' : '' }}>
                        {{ $category->cate_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
</div>
</div>
@endsection
