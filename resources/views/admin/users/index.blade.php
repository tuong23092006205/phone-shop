@extends('layouts.admin')
@section('title', 'Quản lý người dùng')
@section('content')
<table class="table table-hover bg-white shadow-sm">
    <thead class="table-light"><tr><th>#</th><th>Tên</th><th>Email</th><th>Vai trò</th><th>Ngày tạo</th></tr></thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge bg-{{ $u->role=='admin'?'danger':'secondary' }}">{{ $u->role }}</span></td>
            <td>{{ $u->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection