@extends('layouts.app')
@section('title', 'Giỏ hàng')
@section('content')

<h3 class="fw-bold mb-4">🛒 Giỏ hàng của bạn</h3>

@if(empty($cart))
    <div class="text-center py-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <p class="mt-3 text-muted">Giỏ hàng đang trống</p>
        <a href="{{ route('home') }}" class="btn btn-danger">← Tiếp tục mua sắm</a>
    </div>
@else
<div class="row g-4">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>Sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th><th></th></tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($item['image'])
                                        <img src="{{ Storage::url($item['image']) }}" style="width:60px; height:60px; object-fit:contain;">
                                    @endif
                                    <span class="fw-semibold small">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }}₫</td>
                            <td style="width:130px;">
                                <input type="number" class="form-control form-control-sm text-center qty-input"
                                       value="{{ $item['quantity'] }}" data-id="{{ $item['id'] }}" min="1">
                            </td>
                            <td class="fw-bold">{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger btn-remove" data-id="{{ $item['id'] }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Tóm tắt đơn hàng</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tạm tính:</span>
                    <strong id="cart-total">{{ number_format($total, 0, ',', '.') }}₫</strong>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Phí vận chuyển:</span>
                    <span class="text-success">Miễn phí</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Tổng cộng:</span>
                    <strong class="text-danger fs-5" id="cart-total-final">{{ number_format($total, 0, ',', '.') }}₫</strong>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 btn-lg">Tiến hành thanh toán →</a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2">← Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
// Cập nhật số lượng
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function() {
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ product_id: this.dataset.id, quantity: this.value })
        }).then(() => location.reload());
    });
});
// Xóa sản phẩm
document.querySelectorAll('.btn-remove').forEach(btn => {
    btn.addEventListener('click', function() {
        fetch('{{ route("cart.remove") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ product_id: this.dataset.id })
        }).then(() => location.reload());
    });
});
</script>
@endpush