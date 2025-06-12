@extends("admin.layout.master")
@section("title", "Sukien")

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Danh sách văn bản quy phạm pháp luật khác nhá </h3>

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alert-message" role="alert">
            🎉 {{ session('success') }}
        </div>
    @endif

    {{-- Nút thêm mới --}}
    <a href="{{ route('admin.vanbankhac.create') }}" class="btn btn-primary mb-3">➕ Thêm hồ sơ mới</a>

    {{-- Bảng danh sách --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Ngày tạo</th>
                    <th>Ngày sửa</th>
                    <th>File đính kèm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nguyen as $hoso)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hoso->title }}</td>
                        <td>{{ $hoso->description }}</td>
                        <td>
                            @if($hoso->image)
                                <img src="{{ asset($hoso->image) }}" alt="Hình ảnh" class="img-thumbnail" style="width: 100px;">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>{{ $hoso->created_at->format('d/m/Y') }}</td>
                        <td>{{ $hoso->updated_at->format('d/m/Y') }}</td>
                        <td>
                            @if($hoso->file)
                                <a href="{{ asset($hoso->file) }}" target="_blank" class="btn btn-sm btn-outline-success">📎 Tải xuống</a>
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-info" title="Xem" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $hoso->id }}">👁️</button> <!-- Nút Xem -->
                                <a href="{{ route('admin.vanbankhac.edit', $hoso->id) }}" class="btn btn-sm btn-primary" title="Sửa">✏️</a>
                                <form action="{{ route('admin.vanbankhac.destroy', $hoso->_id) }}"  method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn Có Chắc Muốn Xóa Người Dùng Này Không?')" type="submit" class="btn btn-danger">🗑️</button>
                                </form>
                            </div>                                    
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Không có hồ sơ nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
{{-- Phân trang --}}
@foreach($nguyen as $hoso)
<!-- Modal Chi Tiết Hồ Sơ -->
<div class="modal fade" id="viewModal-{{ $hoso->id }}" tabindex="-1" aria-labelledby="viewModalLabel-{{ $hoso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewModalLabel-{{ $hoso->id }}">📄 Chi tiết hồ sơ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body p-4">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-primary mb-2">Thông tin cơ bản</h6>
                                <p><strong>Tiêu đề:</strong> {{ $hoso->title }}</p>
                                <p><strong>Mô tả:</strong> {{ $hoso->description }}</p>
                                <p><strong>Nội dung:</strong> {!! nl2br(e($hoso->content)) !!}</p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-primary mb-2">Thông tin bổ sung</h6>
                                <p><strong>Ngày tạo:</strong> {{ $hoso->created_at->format('d/m/Y H:i:s') }}</p>
                                <p><strong>Ngày sửa:</strong> {{ $hoso->updated_at->format('d/m/Y H:i:s') }}</p>

                                @if ($hoso->image)
                                    <div class="mb-2">
                                        <strong>Hình ảnh:</strong><br>
                                        <img src="{{ asset($hoso->image) }}" alt="Hình ảnh" class="img-fluid rounded shadow-sm mt-2" style="max-width: 300px;">
                                    </div>
                                @endif

                                @if ($hoso->file)
                                    <div class="mt-3">
                                        <strong>File đính kèm:</strong><br>
                                        <a href="{{ asset($hoso->file) }}" target="_blank" class="btn btn-sm btn-outline-success mt-2">📎 Tải xuống</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endforeach




    {{-- Nút quay lại --}}
    <a href="{{ url('/admin') }}" class="btn btn-outline-primary mb-3">
        ← Quay lại Trang Quản trị
    </a>

{{-- Scripts --}}
@push('scripts')
    {{-- Nhúng jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Tự động tắt alert --}}
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert-message').fadeOut('slow');
            }, 3000);
        });
    </script>

    {{-- Xử lý nút xóa --}}
    <script>
        function confirmDelete(id) {
            if (confirm('Bạn có chắc chắn muốn xóa hồ sơ này?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    <script>
    // Tự động ẩn alert sau 3 giây
    setTimeout(function () {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show'); // Loại bỏ lớp show để kích hoạt hiệu ứng fade
            setTimeout(() => {
                successAlert.remove(); // Xóa khỏi DOM sau khi hiệu ứng xong
            }, 300); // 300ms là thời gian mặc định của hiệu ứng fade Bootstrap
        }
    }, 3000); // Sau 3 giây mới bắt đầu ẩn

    // Xác nhận xóa
    function confirmDelete(userId) {
        if (confirm('Bạn có chắc chắn muốn xóa người dùng này không?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
//show user detail modal -->

</script>
@endpush
@endsection
