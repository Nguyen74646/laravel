@extends('admin.layout.master')

@section('content')
    <h2>✏️ Chỉnh sửa bài viết</h2>

    {{-- Hiển thị thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" id="alert-message" role="alert">
            <strong>❗ Có lỗi xảy ra:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alert-message" role="alert">
            🎉 {{ session('success') }}
        </div>
    @endif
    
    <!---------------------------------------------------------------------------------->
    @if(Auth::check() && Auth::user()->role == 'admin')
    <form action="{{ route('admin.congtacphapche.update', ['id' => $congtacphapche->_id]) }}" method="POST" enctype="multipart/form-data">
    @elseif(Auth::check() && Auth::user()->role == 'user')
    <form action="{{ route('user.congtacphapche.update', ['id' => $congtacphapche->_id]) }}" method="POST" enctype="multipart/form-data">
    @endif
    <!---------------------------------------------------------------------------------->
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ $congtacphapche->title }}" required>
        </div>

        <div class="mb-3">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $congtacphapche->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $congtacphapche->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hình ảnh hiện tại:</label>
            @if ($congtacphapche->image)
                <img src="{{ asset($congtacphapche->image) }}" alt="Hình ảnh" style="width: 100px; height: auto;">
            @else
                <p>Không có hình ảnh</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Thay đổi hình ảnh (nếu có):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>File đính kèm hiện tại:</label>
            @if ($congtacphapche->file)
                <a href="{{ asset($congtacphapche->file) }}" target="_blank">Tải xuống file hiện tại</a>
            @else
                <p>Không có file đính kèm</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Thay đổi file đính kèm (nếu có):</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        
    <!---------------------------------------------------------------------------------->

    @if(Auth::check() && Auth::user()->role == 'admin')
    <a href="{{ route('admin.congtacphapche.index') }}" class="btn btn-secondary">← Quay về</a>
    @elseif(Auth::check() && Auth::user()->role == 'user')
    <a href="{{ route('user.congtacphapche.index') }}" class="btn btn-secondary">← Quay về</a>
    @endif
    <!---------------------------------------------------------------------------------->
    </form>
@endsection
