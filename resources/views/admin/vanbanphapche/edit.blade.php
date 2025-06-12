@extends('admin.layout.master')

@section('content')
    <h2>📝 Chỉnh sửa pháp chế</h2>

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

    <form action="{{ route('admin.vanbanphapche.update', $vanbanphapche->_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ $vanbanphapche->title }}">
        </div>

        <div class="mb-3">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control">{{ $vanbanphapche->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung chi tiết:</label>
            <textarea name="content" class="form-control" rows="5">{{ $vanbanphapche->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hình ảnh (nếu muốn thay):</label>
            <input type="file" name="image" class="form-control">
            @if ($vanbanphapche->image)
                <p>Hiện tại: <a href="{{ asset($vanbanphapche->image) }}" target="_blank">Xem hình</a></p>
            @endif
        </div>

        <div class="mb-3">
            <label>Tệp đính kèm (PDF...):</label>
            <input type="file" name="file" class="form-control">
            @if ($vanbanphapche->file)
                <p>Hiện tại: <a href="{{ asset($vanbanphapche->file) }}" target="_blank">Tải tệp</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('admin.vanbanphapche.index') }}" class="btn btn-secondary">← Quay lại</a>
    </form>
@endsection
