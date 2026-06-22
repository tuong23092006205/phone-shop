@extends('layouts.admin')
@section('title', 'Đơn hàng #' . $order->id)
@section('content')
<div class="card p-4 shadow-sm border-0 mb-4">
    <p><strong>Khách hàng:</strong> {{ $order->customer_name }} – {{ $order->customer_phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-flex gap-2">
        @csrf @method('PUT')
        <select name="status" class="form-select" style="width:200px;">
            @foreach(['pending'=>'Chờ duyệt','processing'=>'Đang xử lý','shipping'=>'Đang giao','completed'=>'Hoàn thành','cancelled'=>'Đã hủy'] as $key=>$label)
            <option value="{{ $key }}" {{ $order->status==$key?'selected':'' }}>{{ $label }}</option>
            @endforeach
        </select>
        <button class="btn btn-danger">Cập nhật</button>
    </form>
</div>
<table class="table bg-white shadow-sm">
    <thead><tr><th>Sản phẩm</th><th>SL</th><th>Giá</th><th>Thành tiền</th></tr></thead>
    <tbody>
        @foreach($order->orderDetails as $d)
        <tr>
            <td>{{ $d->product->product_name }}</td>
            <td>{{ $d->quantity }}</td>
            <td>{{ number_format($d->price,0,',','.') }}₫</td>
            <td>{{ number_format($d->price * $d->quantity,0,',','.') }}₫</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection