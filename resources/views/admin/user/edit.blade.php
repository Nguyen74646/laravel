@extends('admin.layout.master')

@section('content')
    <h2>✏️ Chỉnh sửa người dùng</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>❗ Có lỗi xảy ra:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.update',  $user->_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label>Mật khẩu (bỏ trống nếu không đổi):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Địa chỉ:</label>
            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
        </div>

        <div class="mb-3">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>
{{-- -
        <div class="mb-3">
            <label>Quyền hạn :</label>
            <select name="role" class="form-select">
                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                <option value="users" {{ $users->role == 'editor' ? 'selected' : '' }}>Người dùng</option>
            </select>
        </div> --}}
        <select class="form-select" name="role" required>
        <label>Quyền hạn :</label>
            <option value="admin" {{  $user->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Người dùng</option>
        </select>


        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">← Quay về</a>
    </form>
@endsection
