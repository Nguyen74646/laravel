<!-- filepath: c:\laragon\www\lid\resources\views\admin\post\create.blade.php -->
@extends('admin.layout.master')

@section('content')
    <h2>➕ Thêm bài viết mới</h2>

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
    
    <!---------------------------------------------------------------------------------->
    @if(Auth::check() && Auth::user()->role == 'admin')
        <form action="{{ route('admin.congtacphapche.store') }}" method="POST" enctype="multipart/form-data">
    @elseif(Auth::check() && Auth::user()->role == 'user')
        <form action="{{ route('admin.congtacphapche.store') }}" method="POST" enctype="multipart/form-data">
    @endif
    <!---------------------------------------------------------------------------------->
        @csrf

        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Tải lên file:</label>
            <input type="file" name="file" id="file" class="form-control">
         </div>

        <button type="submit" class="btn btn-primary">💾 Lưu bài viết</button>
            <form action="{{ route('admin.congtacphapche.store') }}" method="POST" enctype="multipart/form-data">
        <!---------------------------------------------------------------------------------->
        @if(Auth::check() && Auth::user()->role == 'admin')
            <a href="{{ route('admin.congtacphapche.index') }}" class="btn btn-secondary">← Quay về</a>
        @elseif(Auth::check() && Auth::user()->role == 'user')
            <a href="{{ route('admin.congtacphapche.index') }}" class="btn btn-secondary">← Quay về</a>
        @endif
        <!---------------------------------------------------------------------------------->
    </form>
@endsection