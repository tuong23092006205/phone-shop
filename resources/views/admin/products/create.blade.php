@extends('layouts.admin')
@section('title', 'Thêm sản phẩm')
@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Giá gốc (VNĐ)</label>
            <input type="number" name="base_price" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Giá khuyến mãi (nếu có)</label>
            <input type="number" name="sale_price" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Số lượng tồn kho</label>
            <input type="number" name="stock_quantity" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Ảnh đại diện (thumbnail)</label>
            <input type="file" name="thumbnail" class="form-control" accept="image/*">
        </div>
        <div class="col-md-6">
            <label class="form-label">Ảnh gallery (chọn nhiều ảnh)</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
        </div>
        <div class="col-12">
            <label class="form-label">Mô tả / Thông số kỹ thuật</label>
            <textarea name="description" class="form-control" rows="6"></textarea>
        </div>
    </div>
    <button class="btn btn-danger mt-3">Lưu sản phẩm</button>
</form>
@endsection