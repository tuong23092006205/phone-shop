@extends('layouts.app')
@section('title', $category->category_name)
@section('content')

<h3 class="fw-bold mb-4">{{ $category->category_name }}</h3>

<div class="row">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 mb-4">
            <h6 class="fw-bold">Lọc theo giá</h6>
            <form method="GET">
                <div class="mb-2">
                    <label class="small">Từ:</label>
                    <input type="number" name="min_price" class="form-control form-control-sm"
                           value="{{ request('min_price') }}" placeholder="0">
                </div>
                <div class="mb-2">
                    <label class="small">Đến:</label>
                    <input type="number" name="max_price" class="form-control form-control-sm"
                           value="{{ request('max_price') }}" placeholder="50000000">
                </div>
                <button class="btn btn-danger btn-sm w-100">Áp dụng</button>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">{{ $products->total() }} sản phẩm</span>
            <form method="GET" class="d-flex gap-2">
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="latest" @selected(request('sort')=='latest')>Mới nhất</option>
                    <option value="price_asc" @selected(request('sort')=='price_asc')>Giá tăng dần</option>
                    <option value="price_desc" @selected(request('sort')=='price_desc')>Giá giảm dần</option>
                </select>
            </form>
        </div>
        <div class="row g-3">
            @forelse($products as $product)
                @include('frontend.partials.product-card', ['product' => $product])
            @empty
                <p class="text-muted">Không có sản phẩm nào phù hợp.</p>
            @endforelse
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</div>
@endsection