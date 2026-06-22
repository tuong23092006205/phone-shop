@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('content')
<a href="{{ route('admin.categories.create') }}" class="btn btn-danger mb-3">+ Thêm danh mục</a>
<div class="card shadow-sm border-0">
<table class="table table-hover mb-0">
    <thead class="table-light"><tr><th>#</th><th>Tên danh mục</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->category_name }}</td>
            <td>@if($cat->status)<span class="badge bg-success">Hiện</span>@else<span class="badge bg-secondary">Ẩn</span>@endif</td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{ $categories->links() }}
@endsection