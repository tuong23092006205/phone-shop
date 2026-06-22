@extends('layouts.admin')
@section('title', 'Sửa danh mục')
@section('content')
<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="card p-4 shadow-sm border-0">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }} class="form-check-input">
        <label class="form-check-label">Hiển thị trên menu</label>
    </div>
    <button class="btn btn-danger">Cập nhật</button>
</form>
@endsection