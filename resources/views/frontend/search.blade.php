@extends('layouts.app')
@section('title', 'Kết quả tìm kiếm: ' . $keyword)
@section('content')

<div class="mb-4">
    <h3 class="fw-bold">
        🔍 Kết quả tìm kiếm: 
        <span class="text-danger">"{{ $keyword }}"</span>
    </h3>
    <p class="text-muted">Tìm thấy {{ $products->total() }} sản phẩm</p>
</div>

{{-- Form tìm kiếm lại --}}
<form class="mb-4 d-flex gap-2" action="{{ route('search') }}" method="GET">
    <input type="search" name="q" class="form-control"
           value="{{ $keyword }}" placeholder="Tìm kiếm sản phẩm...">
    <button class="btn btn-danger px-4">Tìm</button>
</form>

@if($products->count())
    <div class="row g-3">
        @foreach($products as $product)
            @include('frontend.partials.product-card', ['product' => $product])
        @endforeach
    </div>

    {{-- Phân trang --}}
    <div class="mt-4">
        {{ $products->appends(['q' => $keyword])->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-muted"></i>
        <p class="mt-3 text-muted fs-5">
            Không tìm thấy sản phẩm nào với từ khóa 
            <strong>"{{ $keyword }}"</strong>
        </p>
        <a href="{{ route('home') }}" class="btn btn-danger mt-2">
            ← Về trang chủ
        </a>
    </div>
@endif

@endsection