@extends('layouts.admin')
@section('title', 'Quản lý đơn hàng')
@section('content')
<table class="table table-hover bg-white shadow-sm">
    <thead class="table-light"><tr><th>#</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
            <td>{{ $order->status }}</td>
            <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endsection