@extends('trang-chu.layout.master')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4 text-dark">
        Kết quả tìm kiếm cho: <span class="fw-normal">"{{ $query }}"</span>
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center shadow-sm">
            <thead class="table-light">
                <tr>
                    <th class="fw-bold" style="width: 5%;">STT</th>
                    <th class="fw-bold" style="width: 40%;">Tên</th>
                    <th class="fw-bold" style="width: 30%;">Đính kèm</th>
                    <th class="fw-bold" style="width: 10%;">Tải về</th>
                </tr>
            </thead>
            <tbody>
                @if ($results->isEmpty())
                    <tr>
                        <td colspan="4" class="text-muted">Không tìm thấy kết quả nào.</td>
                    </tr>
                @else
                    @php $stt = 1; @endphp
                    @foreach ($results as $item)
                        <tr>
                            <td class="fw-bold">{{ $stt++ }}</td>
                            <td class="text-start fw-semibold">
                                {{ $item->title ?? 'Không có tiêu đề' }}
                                @if (!empty($item->description))
                                    <div class="text-muted small">{{ $item->description }}</div>
                                @endif
                            </td>
                            <td>
                                @if (!empty($item->file))
                                    <a href="{{ asset($item->file) }}" target="_blank" class="text-decoration-none text-primary fw-bold">
                                        {{ basename($item->file) }}
                                    </a>
                                @else
                                    <span class="text-muted fw-semibold">Không có file</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($item->file))
                                    <a href="{{ asset($item->file) }}" class="btn btn-success btn-sm" download title="Tải xuống">
                                        <i class="bi bi-download"></i>
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled title="Không có file">
                                        <i class="bi bi-download"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection