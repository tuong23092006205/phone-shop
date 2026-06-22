@extends('layouts.app')
@section('title', 'Chi tiết đơn hàng #' . $order->id)
@section('content')
<h3 class="fw-bold mb-4">Đơn hàng #{{ $order->id }}</h3>
<p>Trạng thái: <span class="badge bg-warning">{{ $order->status }}</span></p>
<p>Người nhận: {{ $order->customer_name }} – {{ $order->customer_phone }}</p>
<p>Địa chỉ: {{ $order->shipping_address }}</p>
<table class="table">
    <thead><tr><th>Sản phẩm</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr></thead>
    <tbody>
        @foreach($order->orderDetails as $detail)
        <tr>
            <td>{{ $detail->product->product_name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
            <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}₫</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h5 class="text-end">Tổng cộng: {{ number_format($order->total_amount, 0, ',', '.') }}₫</h5>
@endsection