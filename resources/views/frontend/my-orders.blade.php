@extends('layouts.app')
@section('title', 'Đơn hàng của tôi')
@section('content')
<h3 class="fw-bold mb-4">Đơn hàng của tôi</h3>
<table class="table table-hover bg-white shadow-sm">
    <thead class="table-light">
        <tr><th>Mã đơn</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th></th></tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
            <td><span class="badge bg-warning">{{ $order->status }}</span></td>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
            <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endsection