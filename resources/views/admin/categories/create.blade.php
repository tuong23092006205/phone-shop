@extends('layouts.admin')
@section('title', 'Thêm danh mục')
@section('content')
<form action="{{ route('admin.categories.store') }}" method="POST" class="card p-4 shadow-sm border-0">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="category_name" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="status" value="1" checked class="form-check-input">
        <label class="form-check-label">Hiển thị trên menu</label>
    </div>
    <button class="btn btn-danger">Lưu</button>
</form>
@endsection