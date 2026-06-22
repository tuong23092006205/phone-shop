<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin – @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .sidebar { width: 250px; min-height: 100vh; background: #1a1a2e; }
        .sidebar a { color: #ccc; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background: rgba(255,255,255,.1); border-radius: 8px; }
        .main-content { flex: 1; background: #f8f9fa; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-3">
        <h5 class="text-white fw-bold mb-4">⚙️ Admin Panel</h5>
        <nav class="d-flex flex-column gap-1">
            <a href="{{ route('admin.dashboard') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-phone"></i> Sản phẩm</a>
            <a href="{{ route('admin.categories.index') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-tag"></i> Danh mục</a>
            <a href="{{ route('admin.orders.index') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-bag-check"></i> Đơn hàng</a>
            <a href="{{ route('admin.users.index') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-people"></i> Người dùng</a>
            <hr class="border-secondary">
            <a href="{{ route('home') }}" class="p-2 d-flex align-items-center gap-2"><i class="bi bi-house"></i> Về trang chủ</a>
        </nav>
    </div>
    <div class="main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">@yield('title')</h4>
            <span class="text-muted small">Xin chào, {{ auth()->user()->name }}</span>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>