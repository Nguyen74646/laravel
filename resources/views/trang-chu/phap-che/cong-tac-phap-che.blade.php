
@extends('trang-chu.layout.master')

@section('content')
  
<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <h2 class="fw-bold text-center pb-2" style="border-bottom: 3px solid #00008B; display: inline-block;">
            Công Tác Pháp Chế
        </h2>
    </div>

    <table class="table mt-4 border-top border-bottom" style="width: 100%; border-color: #00008B;">
        <thead class="bg-light text-dark">
            <tr>
                <th style="width: 50px;">#</th>
                <th class="w-75">Tên</th>
                <th class="text-end">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($congtacphapche as $document)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $document->title }}</td>
                    <td class="text-end">
                       {{-- <a href="{{ route('hoso.show', $document->_id) }}" --}}
                        <a href="{{ url('/phap-che/show-congtacphapche/' . $document->_id) }}" 
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
</div>@endsection

