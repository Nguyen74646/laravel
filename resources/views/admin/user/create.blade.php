@extends("admin.layout.master")
{{-- Đường dẫn breadcrumb --}}
@section('content')
<div class="container mt-4">
    <h3>
        Trang thêm người dùng mới và phân quyền người dùng 
    </h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>❗ Có lỗi xảy ra:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
        </div>
{{-- 
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" required>
        </div>- --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu (phải có ít nhất là 6 kí tự)</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
{{-- - 
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
        </div>--}}
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Phân quyền</label>
            <select class="form-select" name="role" required>

                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>người dùng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu người dùng</button>

        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
            ← Quay về danh sách người dùng 
        </a>


       

    </form>
</div>
@endsection
