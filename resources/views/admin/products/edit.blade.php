@extends('layouts.admin')
@section('title', 'Sửa sản phẩm')
@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST"
      enctype="multipart/form-data" class="card p-4 shadow-sm border-0">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="product_name" class="form-control"
                   value="{{ old('product_name', $product->product_name) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->category_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Giá gốc (VNĐ)</label>
            <input type="number" name="base_price" class="form-control"
                   value="{{ old('base_price', $product->base_price) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Giá khuyến mãi (nếu có)</label>
            <input type="number" name="sale_price" class="form-control"
                   value="{{ old('sale_price', $product->sale_price) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Số lượng tồn kho</label>
            <input type="number" name="stock_quantity" class="form-control"
                   value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Ảnh đại diện (thumbnail)</label>
            @if($product->thumbnail)
                <div class="mb-2">
                    <img src="{{ Storage::url($product->thumbnail) }}"
                         style="width:80px; height:80px; object-fit:contain;" class="border rounded">
                    <span class="small text-muted d-block">Ảnh hiện tại</span>
                </div>
            @endif
            <input type="file" name="thumbnail" class="form-control" accept="image/*">
            <span class="small text-muted">Để trống nếu không muốn đổi ảnh</span>
        </div>
        <div class="col-md-6">
            <label class="form-label">Ảnh gallery (chọn nhiều ảnh)</label>
            @if($product->images->count())
                <div class="d-flex gap-2 mb-2 flex-wrap">
                    @foreach($product->images as $img)
                    <img src="{{ Storage::url($img->image_path) }}"
                         style="width:50px; height:50px; object-fit:cover;" class="border rounded">
                    @endforeach
                </div>
            @endif
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
        </div>
        <div class="col-12">
            <label class="form-label">Mô tả / Thông số kỹ thuật</label>
            <textarea name="description" class="form-control" rows="6">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="col-12 form-check">
            <input type="checkbox" name="status" value="1" class="form-check-input"
                   {{ $product->status ? 'checked' : '' }}>
            <label class="form-check-label">Hiển thị sản phẩm</label>
        </div>
    </div>
    <button class="btn btn-danger mt-3">Cập nhật sản phẩm</button>
</form>
@endsection