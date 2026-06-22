@extends('layouts.app')
@section('title', 'Thanh toán')
@section('content')

<h3 class="fw-bold mb-4">Thông tin giao hàng</h3>
<div class="row">
    <div class="col-md-7">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ và tên người nhận</label>
                <input type="text" name="customer_name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="customer_phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ giao hàng</label>
                <textarea name="shipping_address" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Phương thức thanh toán</label>
                <div class="border rounded p-3 bg-light"><i class="bi bi-cash"></i> Thanh toán khi nhận hàng (COD)</div>
            </div>
            <button class="btn btn-danger btn-lg w-100">Xác nhận đặt hàng</button>
        </form>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm border-0 p-3">
            <h6 class="fw-bold">Đơn hàng của bạn</h6>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="d-flex justify-content-between small mb-2">
                    <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                    <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</span>
                </div>
            @endforeach
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Tổng cộng:</span>
                <span class="text-danger">{{ number_format($total, 0, ',', '.') }}₫</span>
            </div>
        </div>
    </div>
</div>
@endsection