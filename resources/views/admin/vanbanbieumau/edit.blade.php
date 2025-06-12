@extends('admin.layout.master')

@section('content')
    <h2>📝 Chỉnh sửa Quy trình / Quy định</h2>

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

    <form action="{{ route('admin.vanbanbieumau.update', $vanbanbieumau->_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ $vanbanbieumau->title }}">
        </div>

        <div class="mb-3">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control">{{ $vanbanbieumau->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung chi tiết:</label>
            <textarea name="content" class="form-control" rows="5">{{ $vanbanbieumau->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hình ảnh (nếu muốn thay):</label>
            <input type="file" name="image" class="form-control">
            @if ($vanbanbieumau->image)
                <p>Hiện tại: <a href="{{ asset($vanbanbieumau->image) }}" target="_blank">Xem hình</a></p>
            @endif
        </div>

        <div class="mb-3">
            <label>Tệp đính kèm (PDF...):</label>
            <input type="file" name="file" class="form-control">
            @if ($vanbanbieumau->file)
                <p>Hiện tại: <a href="{{ asset($vanbanbieumau->file) }}" target="_blank">Tải tệp</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('admin.vanbanbieumau.index') }}" class="btn btn-secondary">← Quay lại</a>
    </form>
@endsection
