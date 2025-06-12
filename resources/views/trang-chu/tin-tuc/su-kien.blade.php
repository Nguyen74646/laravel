@extends('trang-chu.layout.master')

@section('content')
<div class="mb-2"><h3>Tin Tức Mới</h3></div>
<div class="row">
    @forelse ($hosos as $item)
        <div class="col-md-3 mb-4 d-flex">
            <div class="card flex-fill shadow-sm">
                {{-- Ảnh --}}
                
                @if($item->image && file_exists(public_path($item->image)))
                <img src="{{ asset($item->image) }}" class="card-img-top" class="card-body"
                    class="card-img-top"
                    style="height: 180px; object-fit: cover;">
                @else
                    <img src="{{ asset('storage/image/thumbnail.png') }}" 
                    class="card-img-top" 
                    style="height: 180px; object-fit: cover;">
                @endif
                {{-- Nội dung --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="content flex-grow-1">{{ Str::limit(strip_tags($item->content), 60) }}</p>
                    <p class="time text-muted">Ngày đăng: {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</p>
                    <a href="{{ route('trang-chu.tin-tuc.show-Sukien', ['id' => $item->_id]) }}" 
                    class="btn btn-sm fw-bold text-white"
                    style="background-color: #00008B; border-radius: 6px;">
                    Xem thêm
                    </a>

                </div>
            </div>
        </div>
    @empty
        <p>Không có tin tức.</p>
    @endforelse
</div>

<div class="pt-2 d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
        </ul>
    </nav>
</div>
@endsection
