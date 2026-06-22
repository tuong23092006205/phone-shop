<div class="col-6 col-md-4 col-lg-3">
    <div class="card product-card h-100 border-0 shadow-sm">
        <a href="{{ route('product.show', $product->slug) }}">
            @if($product->thumbnail)
                <img src="{{ Storage::url($product->thumbnail) }}" class="card-img-top"
                     alt="{{ $product->product_name }}" style="height:180px; object-fit:contain; padding:10px;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;">
                    <span class="text-muted">Chưa có ảnh</span>
                </div>
            @endif
        </a>
        <div class="card-body d-flex flex-column p-3">
            <a href="{{ route('product.show', $product->slug) }}" class="text-dark text-decoration-none">
                <h6 class="card-title fw-semibold" style="font-size:.9rem; min-height:2.5em;">{{ $product->product_name }}</h6>
            </a>
            <div class="mt-auto">
                @if($product->sale_price)
                    <div class="price-sale">{{ number_format($product->sale_price, 0, ',', '.') }}₫</div>
                    <div class="price-original">{{ number_format($product->base_price, 0, ',', '.') }}₫</div>
                @else
                    <div class="price-sale">{{ number_format($product->base_price, 0, ',', '.') }}₫</div>
                @endif
                <button class="btn btn-danger btn-sm w-100 mt-2 btn-add-cart" data-id="{{ $product->id }}">
                    <i class="bi bi-cart-plus"></i> Thêm giỏ hàng
                </button>
            </div>
        </div>
    </div>
</div>