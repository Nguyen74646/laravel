<!-- PHẦN HEADER -->
<div class="container header-top py-3">
    <div class="row align-items-center text-center text-md-start">
        <!-- Logo -->
        <div class="col-md-8 col-12 mb-3 mb-md-0">
            <a href="/">
                <img  src="{{ asset('storage/image/logolid.png') }}"class="img-fluid" alt="Phòng Thanh tra - Pháp chế - Sở hữu trí tuệ Trường Đại học An Giang" title="Phòng Thanh tra - Pháp chế - Sở hữu trí tuệ Trường Đại học An Giang">
            </a>
        </div>

        <!-- Email -->
        <div class="col-md-2 col-6 mb-2 mb-md-0">
            <span class="fw-bold text-primary">EMAIL</span><br>
            <a class="text-dark d-block" href="mailto:lid@agu.edu.vn" style="font-size: 1rem;">lid@agu.edu.vn</a>
        </div>

        <!-- Hotline -->
        <div class="col-md-2 col-6">
            <span class="fw-bold text-primary">HOTLINE</span><br>
            <a class="text-dark d-block" href="tel:076945454" style="font-size: 1rem;">(076).945454 - (234)</a>
        </div>
    </div>
</div>

<!-- MENU NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-2">
    <div class="container-fluid">
        <!-- Toggle for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Nav items -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- GIỚI THIỆU -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown">
                        GIỚI THIỆU
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'gioi-thieu','page'=>'chuc-nang-nhiem-vu']) }}">CHỨC NĂNG NHIỆM VỤ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'gioi-thieu','page'=>'co-cau-to-chuc']) }}">CƠ CẤU TỔ CHỨC</a></li>
                    </ul>
                </li>

                <!-- TIN TỨC -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown">
                        TIN TỨC
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'tin-tuc','page'=>'thong-bao']) }}">THÔNG BÁO</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'tin-tuc','page'=>'su-kien']) }}">SỰ KIỆN</a></li>
                    </ul>
                </li>

                <!-- THANH TRA -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown">
                        THANH TRA
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'thanh-tra','page'=>'quy-trinh-quy-dinh']) }}">QUY TRÌNH - QUY ĐỊNH</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'thanh-tra','page'=>'van-ban-bieu-mau']) }}">VĂN BẢN - BIỂU MẪU</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'thanh-tra','page'=>'ke-hoach']) }}">KẾ HOẠCH</a></li>
                    </ul>
                </li>

                <!-- PHÁP CHẾ -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown">
                        PHÁP CHẾ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'phap-che','page'=>'cong-tac-phap-che']) }}">CÔNG TÁC PHÁP CHẾ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'phap-che','page'=>'cong-tac-tiep-cong-dan']) }}">CÔNG TÁC TIẾP CÔNG DÂN</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'phap-che','page'=>'cong-tac-tuyen-truyen-pho-bien-phap-luat']) }}">CÔNG TÁC TUYÊN TRUYỀN PHỔ BIẾN PHÁP LUẬT</a></li>
                    </ul>
                </li>

                <!-- SỞ HỮU TRÍ TUỆ -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown5" role="button" data-bs-toggle="dropdown">
                        SỞ HỮU TRÍ TUỆ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'so-huu-tri-tue','page'=>'shtt-quy-trinh-quy-dinh']) }}">QUY TRÌNH - QUY ĐỊNH</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'so-huu-tri-tue','page'=>'shtt-van-ban-bieu-mau']) }}">VĂN BẢN - BIỂU MẪU</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'so-huu-tri-tue','page'=>'shtt-ke-hoach-cong-van']) }}">KẾ HOẠCH</a></li>
                    </ul>
                </li>

                <!-- VB QUY PHẠM PHÁP LUẬT -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown6" role="button" data-bs-toggle="dropdown">
                        VB QUY PHẠM PHÁP LUẬT
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-quy-pham-phap-luat','page'=>'van-ban-thanh-tra']) }}">VĂN BẢN THANH TRA</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-quy-pham-phap-luat','page'=>'van-ban-phap-che']) }}">VĂN BẢN PHÁP CHẾ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-quy-pham-phap-luat','page'=>'van-ban-so-huu-tri-tue']) }}">VĂN BẢN SỞ HỮU TRÍ TUỆ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-quy-pham-phap-luat','page'=>'van-ban-khac']) }}">VĂN BẢN KHÁC</a></li>
                    </ul>
                </li>

                <!-- VB ĐẠI HỌC QUỐC GIA -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown7" role="button" data-bs-toggle="dropdown">
                        VB ĐẠI HỌC QUỐC GIA
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-dhqg','page'=>'dhqg-van-ban-thanh-tra']) }}">VĂN BẢN THANH TRA</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-dhqg','page'=>'dhqg-van-ban-phap-che']) }}">VĂN BẢN PHÁP CHẾ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-dhqg','page'=>'dhqg-van-ban-so-huu-tri-tue']) }}">VĂN BẢN SỞ HỮU TRÍ TUỆ</a></li>
                        <li><a class="dropdown-item" href="{{ route('trang-chu.pages',['group'=>'van-ban-dhqg','page'=>'dhqg-van-ban-khac']) }}">VĂN BẢN KHÁC</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Search bar -->
            <form action="{{ route('trang-chu.tim-kiem.ket-qua') }}" method="GET" class="d-flex mt-3 mt-lg-0">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="Tìm kiếm..." 
                    class="form-control rounded-start border-primary shadow-sm" 
                    style="height: 45px;" 
                    required>
                <button 
                    type="submit" 
                    class="btn search-btn rounded-end shadow-sm px-4" 
                    style="height: 45px;">
                    <i class="fa-brands fa-searchengin fa-fade fa-xl"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
<!-- END HEADER -->