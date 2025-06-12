@extends('admin.layout.master')
@section("title", "Quản lý Người dùng")

@section('content')
<div class="container mt-4">

    {{-- ✅ Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <strong>✅ Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ❌ Hiển thị lỗi --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Lỗi!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tiêu đề & Thêm người dùng --}}
    <h3>Danh sách quản lý tài khoản người dùng</h3>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">
            ➕ Thêm người dùng
        </a>
    </div>

    {{-- Bảng người dùng --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th>Ngày chỉnh sửa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name ?? 'Không có tên' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->_id }}">👁️</button>
                                <a href="{{ route('admin.user.edit', $user->_id) }}" class="btn btn-sm btn-primary">✏️</a>
                                <form action="{{ route('admin.user.destroy', $user->_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Nút quay lại --}}
    <a href="{{ url('/admin') }}" class="btn btn-outline-primary mb-3">
        ← Quay lại Trang Quản trị
    </a>
</div>
{{-- modal --}}
@foreach ($users as $user)
    <div class="modal fade" id="userModal{{ $user->_id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->_id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="userModalLabel{{ $user->_id }}">Chi tiết người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th>Tên</th><td>{{ $user->name }}</td></tr>
                            <tr><th>Email</th><td>{{ $user->email }}</td></tr>
                            <tr><th>Mật khẩu</th><td>{{ $user->password }}</td></tr>
                            <tr><th>Địa chỉ</th><td>{{ $user->address ?? 'N/A' }}</td></tr>
                            <tr><th>SĐT</th><td>{{ $user->phone ?? 'N/A' }}</td></tr>
                            <tr><th>Quyền hạn</th><td>{{ $user->role ?? 'N/A' }}</td></tr>
                            <tr><th>Ngày tạo</th><td>{{ $user->created_at }}</td></tr>
                            <tr><th>Ngày sửa</th><td>{{ $user->updated_at }}</td></tr>
                            <tr><th>Ghi nhớ</th><td>{{ $user->remember_token ?? 'N/A' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Script --}}
<script>
    // ✅ Tự động ẩn alert sau 3 giây
    setTimeout(function () {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
            setTimeout(() => {
                successAlert.remove();
            }, 300);
        }
    }, 3000);
</script>
@endsection
