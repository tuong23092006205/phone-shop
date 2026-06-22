@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 bg-primary text-white shadow">
            <div class="card-body d-flex justify-content-between">
                <div><div class="fs-4 fw-bold">{{ $totalOrders }}</div><div>Tổng đơn hàng</div></div>
                <i class="bi bi-bag-check fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-success text-white shadow">
            <div class="card-body d-flex justify-content-between">
                <div><div class="fs-4 fw-bold">{{ number_format($totalRevenue, 0, ',', '.') }}₫</div><div>Doanh thu</div></div>
                <i class="bi bi-currency-exchange fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-warning text-white shadow">
            <div class="card-body d-flex justify-content-between">
                <div><div class="fs-4 fw-bold">{{ $totalProducts }}</div><div>Sản phẩm</div></div>
                <i class="bi bi-phone fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-danger text-white shadow">
            <div class="card-body d-flex justify-content-between">
                <div><div class="fs-4 fw-bold">{{ $totalUsers }}</div><div>Khách hàng</div></div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold">Đơn hàng gần đây</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>#</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th></th></tr></thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                    <td><span class="badge bg-warning">{{ $order->status }}</span></td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection