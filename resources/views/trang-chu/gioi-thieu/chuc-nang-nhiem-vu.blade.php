
@extends('trang-chu.layout.master')

@section('content')
  
<section class="col">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold">CHỨC NĂNG NHIỆM VỤ</h2>
            <hr class="mx-auto" style="border-top: medium solid #050c9c; width: 10%; opacity: 1;">
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title font-weight-bold mb-4"><i data-feather="target" class="icon-title"></i> 1. Chức năng</h4>

                <div class="mb-3">
                    <h5 class="font-weight-bold"><i data-feather="check-circle" class="icon-sub"></i> 1.1 Thanh tra:</h5>
                    <p class="text-indent">
                        Phòng TT-PC-SHTT là tổ chức thanh tra nội bộ, tham mưu giúp Hiệu trưởng thanh tra, kiểm tra các hoạt động trong phạm vi quản lý, đảm bảo thi hành pháp luật đúng quy định, bảo vệ quyền lợi nhà trường và cá nhân liên quan.
                    </p>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold"><i data-feather="check-circle" class="icon-sub"></i> 1.2 Pháp chế:</h5>
                    <p class="text-indent">
                        Tham mưu Hiệu trưởng tổ chức quản lý đúng pháp luật; rà soát, kiểm tra văn bản nội bộ; phổ biến, giáo dục pháp luật; kiểm tra việc thực hiện quy định pháp luật trong trường.
                    </p>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold"><i data-feather="check-circle" class="icon-sub"></i> 1.3 Sở hữu trí tuệ:</h5>
                    <p class="text-indent">
                        Hỗ trợ Ban Giám hiệu quản trị tài sản SHTT; hỗ trợ hoạt động đào tạo, nghiên cứu khoa học và chuyển giao công nghệ liên quan đến sở hữu trí tuệ trong trường.
                    </p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title font-weight-bold mb-4"><i data-feather="layers" class="icon-title"></i> 2. Nhiệm vụ</h4>

                <div class="mb-4">
                    <h5 class="font-weight-bold"><i data-feather="list" class="icon-sub"></i> 2.1 Thanh tra, kiểm tra</h5>
                    <ul class="custom-list">
                        <li>Xây dựng kế hoạch thanh tra, kiểm tra định kỳ hoặc đột xuất.</li>
                        <li>Thanh tra, kiểm tra hoạt động của tổ chức, cá nhân.</li>
                        <li>Tiếp công dân, xử lý đơn thư phản ánh, khiếu nại, tố cáo.</li>
                        <li>Thực hiện nhiệm vụ phòng, chống tham nhũng.</li>
                        <li>Phối hợp các đơn vị, cơ quan thực hiện công tác thanh tra.</li>
                        <li>Báo cáo tổng kết công tác theo yêu cầu cấp trên.</li>
                        <li>Thực hiện các nhiệm vụ thanh tra khác do Ban Giám hiệu giao.</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5 class="font-weight-bold"><i data-feather="list" class="icon-sub"></i> 2.2 Công tác pháp chế</h5>
                    <ul class="custom-list">
                        <li>Tham mưu, hỗ trợ Ban Giám hiệu về các vấn đề pháp lý.</li>
                        <li>Góp ý, kiểm tra văn bản quy phạm pháp luật và văn bản nội bộ.</li>
                        <li>Tuyên truyền, phổ biến, giáo dục pháp luật trong trường.</li>
                        <li>Theo dõi, kiểm tra việc thực hiện các quy định pháp luật.</li>
                        <li>Kiến nghị biện pháp phòng ngừa và xử lý vi phạm.</li>
                        <li>Báo cáo công tác pháp chế theo yêu cầu.</li>
                        <li>Thực hiện các nhiệm vụ pháp chế khác do Ban Giám hiệu giao.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold"><i data-feather="list" class="icon-sub"></i> 2.3 Hoạt động sở hữu trí tuệ</h5>
                    <ul class="custom-list">
                        <li>Tham mưu Hiệu trưởng về quản trị tài sản SHTT.</li>
                        <li>Hỗ trợ đơn vị, cá nhân khai thác và bảo vệ quyền SHTT.</li>
                        <li>Giáo dục, phổ biến pháp luật về sở hữu trí tuệ.</li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Feather Icons CDN -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace()
</script>

<style>
    .text-indent {
        text-indent: 2rem;
    }
    .icon-title {
        width: 28px;
        height: 28px;
        color: #050c9c;
        margin-right: 8px;
    }
    .icon-sub {
        width: 20px;
        height: 20px;
        color: #0056b3;
        margin-right: 6px;
    }
    .custom-list {
        padding-left: 2rem;
        list-style: none;
    }
    .custom-list li::before {
        content: '▶';
        color: #050c9c;
        margin-right: 8px;
        font-size: 0.8rem;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
</style>

@endsection

