@extends('admin.layout.master')

@section('content')
    <h2>✏️ Chỉnh sửa bài dhqg sở hữu trí tuệ này nha</h2>

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

    <form action="{{ route('admin.dhqgvanbansohuutritue.update', ['id' => $dhqgvanbansohuutritue->_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề:</label>
            <input type="text" name="title" class="form-control" value="{{ $dhqgvanbansohuutritue->title }}" required>
        </div>

        <div class="mb-3">
            <label>Mô tả:</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $dhqgvanbansohuutritue->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $dhqgvanbansohuutritue->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Hình ảnh hiện tại:</label>
            @if ($dhqgvanbansohuutritue->image)
                <img src="{{ asset($dhqgvanbansohuutritue->image) }}" alt="Hình ảnh" style="width: 100px; height: auto;">
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
            @if ($dhqgvanbansohuutritue->file)
                <a href="{{ asset($dhqgvanbansohuutritue->file) }}" target="_blank">Tải xuống file hiện tại</a>
            @else
                <p>Không có file đính kèm</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Thay đổi file đính kèm (nếu có):</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('admin.dhqgvanbansohuutritue.index') }}" class="btn btn-secondary">← Quay về</a>
    </form>
@endsection
