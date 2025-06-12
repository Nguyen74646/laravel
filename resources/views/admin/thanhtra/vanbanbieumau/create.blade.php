<!-- filepath: c:\laragon\www\lid\resources\views\admin\post\create.blade.php -->
@extends('admin.layout.master')

@section('content')
    <h2>➕ Thêm biểu mẫu thanh tra mới</h2>

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

    <form action="{{ route('admin.quytrinhquydinh.store') }}" method="POST" enctype="multipart/form-data">
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
            <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>

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
        <a href="{{ route('admin.quytrinhquydinh.index') }}" class="btn btn-secondary">← Quay về</a>
    </form>
@endsection

@push('scripts')
    {{-- Tùy chọn 2: Sử dụng phiên bản hiện tại và ẩn thông báo --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('content')) {
                CKEDITOR.replace('content', {
                    height: 300,
                    language: 'vi',

                    // Tùy chỉnh thanh công cụ để gọn gàng hơn
                    toolbar: [
                        { name: 'document', items: [ 'Source' ] },
                        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
                        '/', // Xuống dòng mới trên toolbar
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
                        '/', // Xuống dòng mới
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
                    ],
                });

                // Chỉ thêm CSS để ẩn thông báo nếu bạn KHÔNG nâng cấp lên phiên bản LTS
                // Đoạn này sẽ chạy vì bạn đang dùng 4.22.1
                var cdnUrlElement = document.querySelector('script[src*="cdn.ckeditor.com"]');
                if (cdnUrlElement) { // Kiểm tra xem phần tử có tồn tại không
                    var cdnUrl = cdnUrlElement.src;
                    if (!cdnUrl.includes('4.25.1-lts')) { // Kiểm tra nếu không phải phiên bản LTS mới nhất
                        var style = document.createElement('style');
                        style.type = 'text/css';
                        style.innerHTML = '.cke_notifications_area { display: none !important; }';
                        document.getElementsByTagName('head')[0].appendChild(style);
                    }
                }

            } else {
                console.error("CKEditor: Không tìm thấy textarea với ID 'content'.");
            }
        });
    </script>
@endpush