<h4 class="text-center my-4 fw-bold">Văn bản- Quy định MỚI NHẤT</h4>

<div class="container">
    <div class="row">
        @forelse ($van_ban_moi as $item)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-4 d-flex">
                <div class="card shadow-sm h-100 w-100 d-flex flex-column">
                    <div style="height: 180px; overflow: hidden;">
                        @if($item->image && file_exists(public_path($item->image)))
                            <img src="{{ asset($item->image) }}" class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/image/thumbnail.png') }}" class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <small class="text-muted mb-2">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}
                        </small>
                        <h6 class="fw-bold text-dark" style="min-height: 48px;">
                            {{ Str::limit($item->title, 80) }}
                        </h6>
                        <p class="flex-grow-1 text-dark" style="font-size: 14px;">
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        <a href="{{ route('trang-chu.thanh-tra.show-bieumau', ['id' => $item->_id]) }}"
                           class="btn btn-sm fw-bold text-white mt-auto"
                           style="background-color: #00008B; border-radius: 6px;">
                            Xem thêm
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-dark">Không có tin tức.</p>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $van_ban_moi->appends(['type' => 'vanban'])->links('pagination::bootstrap-5') }}
    </div>

</div>

