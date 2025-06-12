
@extends('trang-chu.layout.master')

@section('content')
  
<section class="col">
                <div class="container mt-5">

                    {{-- Tiêu đề --}}
                    <h2 class="text-center fw-bold text-dark mb-3">KẾ HOẠCH</h2>

                    {{-- Đường kẻ ngang màu xanh --}}
                    <hr style="height: 2px; background-color: #0d6efd; border: none; opacity: 1;" class="mb-4">

                    {{-- Bảng nội dung --}}
                    <div class="table-responsive"> {{-- Thêm class này để bảng cuộn ngang trên màn hình nhỏ --}}
                    <table class="table mt-4 border-top border-bottom" style="width: 100%; border-color: #00008B;">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th class="w-75">Tên</th>
                                <th class="text-end">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nguyen as $document)
                                <tr style="border-bottom: 1px solid #dee2e6;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $document->title }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('trang-chu.thanh-tra.show-kehoach', $document->_id) }}"
                                        class="btn btn-sm fw-bold text-white"
                                        style="background-color: #00008B; border-radius: 6px;">
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </section>
@endsection

