<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Thế Giới Thiết Bị')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        :root { --primary: #e31837; --primary-dark: #b5122b; }
        .navbar { background: var(--primary) !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .product-card { transition: transform .2s, box-shadow .2s; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
        .price-sale { color: var(--primary); font-weight: 700; font-size: 1.1rem; }
        .price-original { text-decoration: line-through; color: #999; font-size: .85rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">📱 Thế Giới Thiết Bị</a>
        <form class="d-flex mx-auto w-50" action="{{ route('search') }}" method="GET">
            <input class="form-control me-2" type="search" name="q" placeholder="Tìm điện thoại, laptop..." value="{{ request('q') }}">
            <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('cart.index') }}" class="text-white text-decoration-none position-relative">
                <i class="bi bi-cart3 fs-5"></i>
                <span class="badge bg-warning text-dark position-absolute top-0 start-100 translate-middle cart-count">
                    {{ collect(session('cart', []))->sum('quantity') }}
                </span>
            </a>
            @auth
                <div class="dropdown">
                    <a class="text-white text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('orders.index') }}">Đơn hàng của tôi</a></li>
                        @if(auth()->user()->isAdmin())
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Quản trị</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><form action="{{ route('logout') }}" method="POST">@csrf<button class="dropdown-item text-danger">Đăng xuất</button></form></li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Đăng ký</a>
            @endauth
        </div>
    </div>
</nav>
<div class="bg-dark py-1">
    <div class="container">
        <nav class="d-flex gap-4">
            @foreach(App\Models\Category::where('status',1)->get() as $cat)
            <a href="{{ route('category.show', $cat->slug) }}" class="text-white text-decoration-none small fw-semibold">{{ $cat->category_name }}</a>
            @endforeach
        </nav>
    </div>
</div>
<main class="py-4">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>
</main>
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1">© 2026 Thế Giới Thiết Bị – Niên luận cơ sở của Lý Minh Thiên Tường</p>
        <small class="text-muted">PHP Laravel · Bootstrap 5 · MySQL</small>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@push('scripts')
<script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-add-cart');
    if (!btn) return;
    const productId = btn.dataset.id;
    const quantity = document.getElementById('quantity')?.value ?? 1;
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.querySelectorAll('.cart-count').forEach(el => el.textContent = data.cart_count);
            showToast(data.success, 'success');
        } else {
            showToast(data.error, 'danger');
        }
    });
});
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} position-fixed bottom-0 end-0 m-3 shadow`;
    toast.style.zIndex = '9999';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2500);
}
</script>
@endpush
@stack('scripts')
</body>
</html>