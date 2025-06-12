<!-- filepath: c:\laragon\www\lid\resources\views\admin\post\create.blade.php -->
@extends('admin.layout.master')

@section('content')
    <h2>➕ Thêm văn bản sở hữu trí tuệ dhqg mới nhá</h2>

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

    <form action="{{ route('admin.dhqgvanbansohuutritue.store') }}" method="POST" enctype="multipart/form-data">
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
        <a href="{{ route('admin.dhqgvanbansohuutritue.index') }}" class="btn btn-secondary">← Quay về</a>
    </form>
@endsection