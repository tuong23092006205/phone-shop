@extends('layouts.app')
@section('title', $product->product_name)
@section('content')

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->category_name }}</a>
        </li>
        <li class="breadcrumb-item active">{{ $product->product_name }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-5">
        @if($product->thumbnail)
            <img src="{{ Storage::url($product->thumbnail) }}" class="img-fluid rounded shadow"
                 alt="{{ $product->product_name }}" style="max-height:400px; width:100%; object-fit:contain;">
        @endif
        @if($product->images->count())
        <div class="d-flex gap-2 mt-3 flex-wrap">
            @foreach($product->images as $img)
            <img src="{{ Storage::url($img->image_path) }}" class="rounded border"
                 style="width:70px; height:70px; object-fit:cover; cursor:pointer;">
            @endforeach
        </div>
        @endif
    </div>

    <div class="col-md-7">
        <h1 class="h3 fw-bold">{{ $product->product_name }}</h1>
        <p class="text-muted small">Danh mục: {{ $product->category->category_name }}</p>

        <div class="my-3">
            @if($product->sale_price)
                <span class="price-sale fs-3">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                <span class="price-original ms-2">{{ number_format($product->base_price, 0, ',', '.') }}₫</span>
                <span class="badge bg-danger ms-2">
                    -{{ round((($product->base_price - $product->sale_price) / $product->base_price) * 100) }}%
                </span>
            @else
                <span class="price-sale fs-3">{{ number_format($product->base_price, 0, ',', '.') }}₫</span>
            @endif
        </div>

        <p class="text-success fw-semibold">
            <i class="bi bi-check-circle-fill"></i>
            @if($product->stock_quantity > 0)
                Còn {{ $product->stock_quantity }} sản phẩm trong kho
            @else
                <span class="text-danger">Hết hàng</span>
            @endif
        </p>

        <div class="d-flex align-items-center gap-3 my-3">
            <label class="fw-semibold">Số lượng:</label>
            <div class="input-group" style="width:130px;">
                <button class="btn btn-outline-secondary" onclick="changeQty(-1)">−</button>
                <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
                <button class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
            </div>
        </div>

        <div class="d-flex gap-3 mb-4">
            <button class="btn btn-danger btn-lg flex-fill btn-add-cart" data-id="{{ $product->id }}" id="btnAddCart"
                    @if($product->stock_quantity < 1) disabled @endif>
                <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
            </button>
            <a href="{{ route('checkout.index') }}" class="btn btn-outline-danger btn-lg flex-fill">Mua ngay</a>
        </div>

        @if($product->description)
        <div class="mt-4">
            <h5 class="fw-bold border-bottom pb-2">Mô tả & Thông số kỹ thuật</h5>
            <div class="product-description mt-3">{!! $product->description !!}</div>
        </div>
        @endif
    </div>
</div>

@if($related->count())
<section class="mt-5">
    <h5 class="fw-bold mb-3">Sản phẩm liên quan</h5>
    <div class="row g-3">
        @foreach($related as $p)
            @include('frontend.partials.product-card', ['product' => $p])
        @endforeach
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('quantity');
    const val = parseInt(input.value) + delta;
    if (val >= 1) input.value = val;
}
</script>
@endpush