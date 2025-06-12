@extends('trang-chu.layout.master')

@section('content')

<div class="container my-5">
    <h2 class="text-center fw-bold mb-3">CƠ CẤU TỔ CHỨC</h2>
    <hr class="title-underline">

    <!-- Hàng 1: Trưởng phòng (1 người) -->
    <div class="row justify-content-center mb-4"> {{-- mb-4 để tạo khoảng cách với hàng chuyên viên --}}
        {{-- Trưởng phòng --}}
        <div class="col-md-7 col-lg-4 d-flex"> {{-- col-lg-4 để card thon gọn, col-md-7 để trên tablet không quá hẹp --}}
            <div class="card staff-card text-center shadow-sm h-100 w-100">
                <div class="card-body d-flex flex-column"> {{-- d-flex flex-column để căn chỉnh nội dung tốt hơn nếu card có chiều cao khác nhau --}}
                    <img class="rounded-circle mb-3 staff-avatar align-self-center" src="{{ asset('storage/cctc/20241212102803_675a5843796f4.jpg') }}" alt="Ths. Trần Minh Tâm">
                    <h5 class="card-title fw-bold staff-name">Ths. Trần Minh Tâm</h5>
                    <p class="staff-role text-primary fw-semibold">Trưởng phòng</p>
                    <div class="staff-contact mt-auto"> {{-- mt-auto để đẩy phần contact xuống dưới nếu card có không gian thừa --}}
                        <p class="mb-1"><i data-feather="mail" class="icon-contact"></i> <a href="mailto:tmtam@agu.edu.vn" class="text-decoration-none text-muted">tmtam@agu.edu.vn</a></p>
                        <p class="mb-0"><i data-feather="phone" class="icon-contact"></i> <a href="tel:0918594817" class="text-decoration-none text-muted">0918 594 817</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hàng 2: Chuyên viên (2 người) -->
    {{-- gx-lg-5 để tăng khoảng cách ngang giữa 2 card chuyên viên trên màn hình lớn --}}
    {{-- Nếu muốn khoảng cách mặc định thì dùng gx-4 (hoặc bỏ hẳn gx-*) --}}
    <div class="row gy-4 gx-md-4 gx-lg-5 justify-content-center">
        {{-- Chuyên viên Hoàng Mạnh Cường --}}
        <div class="col-sm-8 col-md-6 col-lg-4 d-flex"> {{-- col-lg-4, col-sm-8 để trên mobile card không quá hẹp --}}
            <div class="card staff-card text-center shadow-sm h-100 w-100">
                <div class="card-body d-flex flex-column">
                    <img class="rounded-circle mb-3 staff-avatar align-self-center" src="{{ asset('storage/cctc/hmcuong.jpg') }}" alt="Ths. Hoàng Mạnh Cường">
                    <h5 class="card-title fw-bold staff-name">Ths. Hoàng Mạnh Cường</h5>
                    <p class="staff-role text-primary fw-semibold">Chuyên viên</p>
                    <div class="staff-contact mt-auto">
                        <p class="mb-1"><i data-feather="mail" class="icon-contact"></i> <a href="mailto:hmcuong@agu.edu.vn" class="text-decoration-none text-muted">hmcuong@agu.edu.vn</a></p>
                        <p class="mb-0"><i data-feather="phone" class="icon-contact"></i> <a href="tel:0972875252" class="text-decoration-none text-muted">0972 875 252</a></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chuyên viên chính Nguyễn Thị Minh Hải --}}
        <div class="col-sm-8 col-md-6 col-lg-4 d-flex">
            <div class="card staff-card text-center shadow-sm h-100 w-100">
                <div class="card-body d-flex flex-column">
                    <img class="rounded-circle mb-3 staff-avatar align-self-center" src="{{ asset('storage/cctc/ntminhhai.jpg') }}" alt="TS. Nguyễn Thị Minh Hải">
                    <h5 class="card-title fw-bold staff-name">TS. Nguyễn Thị Minh Hải</h5>
                    <p class="staff-role text-primary fw-semibold">Chuyên viên chính</p>
                    <div class="staff-contact mt-auto">
                        <p class="mb-1"><i data-feather="mail" class="icon-contact"></i> <a href="mailto:ntminhhai@agu.edu.vn" class="text-decoration-none text-muted">ntminhhai@agu.edu.vn</a></p>
                        <p class="mb-0"><i data-feather="phone" class="icon-contact"></i> <a href="tel:0384797789" class="text-decoration-none text-muted">0384 797 789</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Kết thúc hàng 2 chuyên viên đầu -->

    <!-- Hàng 3: Chuyên viên (2 người) -->
    <div class="row gy-4 gx-md-4 gx-lg-5 justify-content-center mt-4"> {{-- mt-4 để tạo khoảng cách với hàng trên --}}
        {{-- Chuyên viên Lê Xuân Giới --}}
        <div class="col-sm-8 col-md-6 col-lg-4 d-flex">
            <div class="card staff-card text-center shadow-sm h-100 w-100">
                <div class="card-body d-flex flex-column">
                    <img class="rounded-circle mb-3 staff-avatar align-self-center" src="{{ asset('storage/cctc/lxgioi.jpg') }}" alt="CN. Lê Xuân Giới">
                    <h5 class="card-title fw-bold staff-name">CN. Lê Xuân Giới</h5>
                    <p class="staff-role text-primary fw-semibold">Chuyên viên</p>
                    <div class="staff-contact mt-auto">
                        <p class="mb-1"><i data-feather="mail" class="icon-contact"></i> <a href="mailto:lxgioi@agu.edu.vn" class="text-decoration-none text-muted">lxgioi@agu.edu.vn</a></p>
                        <p class="mb-0"><i data-feather="phone" class="icon-contact"></i> <a href="tel:0989584858" class="text-decoration-none text-muted">0989 584 858</a></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chuyên viên Lê Mỹ Nhi --}}
        <div class="col-sm-8 col-md-6 col-lg-4 d-flex">
            <div class="card staff-card text-center shadow-sm h-100 w-100">
                <div class="card-body d-flex flex-column">
                    <img class="rounded-circle mb-3 staff-avatar align-self-center" src="{{ asset('storage/cctc/lmnhi.jpg') }}" alt="CN. Lê Mỹ Nhi">
                    <h5 class="card-title fw-bold staff-name">CN. Lê Mỹ Nhi</h5>
                    <p class="staff-role text-primary fw-semibold">Chuyên viên</p>
                    <div class="staff-contact mt-auto">
                        <p class="mb-1"><i data-feather="mail" class="icon-contact"></i> <a href="mailto:lmnhi@agu.edu.vn" class="text-decoration-none text-muted">lmnhi@agu.edu.vn</a></p>
                        <p class="mb-0"><i data-feather="phone" class="icon-contact"></i> <a href="tel:086822925" class="text-decoration-none text-muted">0868 229 25</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Kết thúc hàng 2 chuyên viên sau -->

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });
</script>

<style>
    /* CSS giữ nguyên như bạn đã có ở lần trước, không cần thay đổi nhiều */
    :root {
        --primary-color: #050c9c;
        --text-muted-custom: #6c757d;
    }

    .title-underline {
        border-top-color: var(--primary-color);
        border-top-width: 3px;
        width: 80px;
        opacity: 1;
        margin: 0 auto 2.5rem auto;
    }

    .staff-card {
        border: 1px solid #e0e0e0;
        border-radius: 0.75rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Thêm padding bên trong card để nội dung không sát viền quá */
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .staff-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
    }

    .staff-avatar {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 4px solid var(--primary-color);
        /* align-self-center đã được thêm vào HTML */
    }

    .staff-name {
        color: #333;
        font-size: 1.25rem;
        margin-top: 0.5rem; /* Khoảng cách nhỏ giữa avatar và tên */
    }

    .staff-role {
        font-size: 0.95rem;
        margin-bottom: 0.75rem; /* Tăng khoảng cách dưới chức vụ */
    }
    .staff-role.text-primary {
        color: var(--primary-color) !important;
    }

    .staff-contact {
        /* mt-auto trong HTML sẽ giúp đẩy khối này xuống nếu card có chiều cao dư */
    }
    .staff-contact p {
        font-size: 0.9rem;
        color: var(--text-muted-custom);
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1.6;
    }

    .staff-contact a {
        color: var(--text-muted-custom);
        transition: color 0.2s ease;
    }
    .staff-contact a:hover {
        color: var(--primary-color);
    }

    .icon-contact {
        width: 1em;
        height: 1em;
        margin-right: 0.5rem;
        color: var(--primary-color);
    }

    @media (max-width: 767.98px) { /* md */
        .staff-avatar {
            width: 100px;
            height: 100px;
        }
        .staff-name {
            font-size: 1.1rem;
        }
    }
    @media (max-width: 575.98px) { /* sm */
        .staff-card {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
         .staff-avatar {
            width: 90px;
            height: 90px;
        }
    }
</style>

@endsection