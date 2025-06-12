@extends('trang-chu.layout.master')

@section('title', 'Chi tiết tin tức')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Cột bên trái: Thông tin chi tiết -->
        <div class="col-md-8">
         
            <h2 class="text-dark fw-bold">{{ $hoso->title }}</h2>
            <p class="text-muted">Ngày đăng: {{ \Carbon\Carbon::parse($hoso->created_at)->format('d/m/Y H:i:s') }}</p>
            <hr>
            <div> <!-- Hoặc không có thẻ bao bọc nào cả -->
                {!! $hoso->content !!}
            </div>

            <!-- Khung tải về -->
            <div class="mt-5">
                <h4 class="text-dark fw-bold">📥 Tải về</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Nội dung</th>
                            <th>Tải về</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                @if ($hoso->file)
                                    <a href="{{ asset($hoso->file) }}" target="_blank" class="text-decoration-none">
                                        {{ basename($hoso->file) }}
                                    </a>
                                @else
                                    <span class="text-muted">Không có file</span>
                                @endif
                            </td>
                            <td>
                                @if ($hoso->file)
                                    <a href="{{ asset($hoso->file) }}" class="btn btn-success btn-sm" download>
                                        ⬇️
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        ⬇️
                                    </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cột bên phải: Tin tức mới -->
        <div class="col-md-4">
            <h4 class="fw-bold text-dark">📰 Tin tức mới</h4>
            <ul class="list-group">
            @foreach ($tin_moi_nhat as $item)
                <i><a href="">{{ $item -> title }}</a></i>
            @endforeach

            </ul>
        </div>


    </div>
</div>
@endsection