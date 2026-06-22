@extends('layouts.admin')
@section('title', 'Quản lý sản phẩm')
@section('content')
<a href="{{ route('admin.products.create') }}" class="btn btn-danger mb-3">+ Thêm sản phẩm</a>
<div class="card shadow-sm border-0">
<table class="table table-hover mb-0">
    <thead class="table-light"><tr><th>Ảnh</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>Tồn kho</th><th></th></tr></thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>@if($p->thumbnail)<img src="{{ Storage::url($p->thumbnail) }}" style="width:50px;height:50px;object-fit:contain;">@endif</td>
            <td>{{ $p->product_name }}</td>
            <td>{{ $p->category->category_name }}</td>
            <td>{{ number_format($p->base_price, 0, ',', '.') }}₫</td>
            <td>{{ $p->stock_quantity }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{{ $products->links() }}
@endsection