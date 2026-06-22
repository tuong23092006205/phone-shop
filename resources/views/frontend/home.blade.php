@extends('layouts.app')
@section('title', 'Trang chủ - Thế Giới Thiết Bị')
@section('content')

<div class="bg-primary text-white text-center rounded-3 p-5 mb-5"
     style="background: linear-gradient(135deg,#e31837,#ff6b35)!important;">
    <h2 class="fw-bold display-5">📱 Điện thoại mới nhất 2026</h2>
    <p>Giảm đến 30% – Miễn phí vận chuyển</p>
    <a href="{{ route('category.show', 'dien-thoai') }}" class="btn btn-light btn-lg">Xem ngay</a>
</div>

@if($featuredPhones->count())
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">📱 Điện thoại mới về</h4>
        <a href="{{ route('category.show', 'dien-thoai') }}" class="btn btn-outline-danger btn-sm">Xem tất cả →</a>
    </div>
    <div class="row g-3">
        @foreach($featuredPhones as $product)
            @include('frontend.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

@if($featuredLaptops->count())
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">💻 Máy tính bán chạy</h4>
        <a href="{{ route('category.show', 'may-tinh') }}" class="btn btn-outline-danger btn-sm">Xem tất cả →</a>
    </div>
    <div class="row g-3">
        @foreach($featuredLaptops as $product)
            @include('frontend.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

@endsection