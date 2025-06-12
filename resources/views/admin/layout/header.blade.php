<div id="sidebar" class="bg-light border-end">
    @if(Auth::check())
        <div class="sidebar-header d-flex align-items-center">
            <h5>✨ {{ Auth::user()->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}</h5>
        </div>

        <nav class="nav flex-column p-3">
            <button id="showSidebarBtn" onclick="toggleSidebar()" class="btn btn-sm btn-outline-secondary me-2">☰</button>

            @php
                $navItems = [
                    'admin' => [
                        ['route' => 'admin.pages_admin', 'group' => 'user', 'label' => 'Người dùng', 'icon' => '👤'],
                        ['route' => 'admin.pages_admin', 'group' => 'sukien', 'label' => 'Sự Kiện', 'icon' => '📝'],
                        ['route' => 'admin.pages_admin', 'group' => 'thongbao', 'label' => 'Thông báo', 'icon' => '📝'],
                        ['route' => 'admin.pages_admin', 'group' => 'thanhtra', 'label' => 'Thanh tra', 'icon' => '📰', 'subMenu' => [
                            ['route' => 'admin.pages_admin', 'group' => 'quytrinhquydinh', 'label' => 'Quy trình - quy định'],
                            ['route' => 'admin.pages_admin', 'group' => 'vanbanbieumau', 'label' => 'Văn bản biểu mẫu'],
                            ['route' => 'admin.pages_admin', 'group' => 'kehoach', 'label' => 'Kế hoạch AGU']
                        ]],
                        ['route' => 'admin.pages_admin', 'group' => 'phapche', 'label' => 'Pháp chế', 'icon' => '⚖️', 'subMenu' => [
                            ['route' => 'admin.pages_admin', 'group' => 'congtacphapche', 'label' => 'Công tác pháp chế'],
                            ['route' => 'admin.pages_admin', 'group' => 'congtactiepcongdan', 'label' => 'Công tác tiếp công dân'],
                            ['route' => 'admin.pages_admin', 'group' => 'congtactuyentruyenphobienphapluat', 'label' => 'Tuyên truyền pháp luật']
                        ]],
                        ['route' => 'admin.pages_admin', 'group' => 'shtt', 'label' => 'Sở hữu trí tuệ', 'icon' => '💡', 'subMenu' => [
                            ['route' => 'admin.pages_admin', 'group' => 'shttquytrinh', 'label' => 'Quy trình - quy định'],
                            ['route' => 'admin.pages_admin', 'group' => 'shttvanbanbieumau', 'label' => 'Văn bản biểu mẫu'],
                            ['route' => 'admin.pages_admin', 'group' => 'shttkehoachcongvan', 'label' => 'Kế hoạch/Công văn']
                        ]],
                        ['route' => 'admin.pages_admin', 'group' => 'vbpl', 'label' => 'VB pháp luật', 'icon' => '📘', 'subMenu' => [
                            ['route' => 'admin.pages_admin', 'group' => 'vanbanthanhtra', 'label' => 'VB thanh tra'],
                            ['route' => 'admin.pages_admin', 'group' => 'vanbanphapche', 'label' => 'VB pháp chế'],
                            ['route' => 'admin.pages_admin', 'group' => 'vanbansohuutritue', 'label' => 'VB SHTT'],
                            ['route' => 'admin.pages_admin', 'group' => 'vanbankhac', 'label' => 'VB khác']
                        ]],
                        ['route' => 'admin.pages_admin', 'group' => 'vbdhqg', 'label' => 'VB - ĐHQG', 'icon' => '🏛️', 'subMenu' => [
                            ['route' => 'admin.pages_admin', 'group' => 'dhqgvanbanthanhtra', 'label' => 'VB thanh tra'],
                            ['route' => 'admin.pages_admin', 'group' => 'dhqgvanbanphapche', 'label' => 'VB pháp chế'],
                            ['route' => 'admin.pages_admin', 'group' => 'dhqgvanbansohuutritue', 'label' => 'VB SHTT'],
                            ['route' => 'admin.pages_admin', 'group' => 'dhqgvanbankhac', 'label' => 'VB khác']
                        ]],
                    ],
                    'user' => [
                        ['route' => 'user.pages_user', 'group' => 'sukien', 'label' => 'Sự Kiện', 'icon' => '📝'],
                        ['route' => 'user.pages_user', 'group' => 'thongbao', 'label' => 'Thông báo', 'icon' => '📝'],
                        ['route' => 'user.pages_user', 'group' => 'thanhtra', 'label' => 'Thanh tra', 'icon' => '📰', 'subMenu' => [
                            ['route' => 'user.pages_user', 'group' => 'quytrinhquydinh', 'label' => 'Quy trình - quy định'],
                            ['route' => 'user.pages_user', 'group' => 'vanbanbieumau', 'label' => 'Văn bản biểu mẫu'],
                            ['route' => 'user.pages_user', 'group' => 'kehoach', 'label' => 'Kế hoạch AGU']
                        ]],
                        ['route' => 'user.pages_user', 'group' => 'phapche', 'label' => 'Pháp chế', 'icon' => '⚖️', 'subMenu' => [
                            ['route' => 'user.pages_user', 'group' => 'congtacphapche', 'label' => 'Công tác pháp chế'],
                            ['route' => 'user.pages_user', 'group' => 'congtactiepcongdan', 'label' => 'Công tác tiếp công dân'],
                            ['route' => 'user.pages_user', 'group' => 'congtactuyentruyenphobienphapluat', 'label' => 'Tuyên truyền pháp luật']
                        ]],
                        ['route' => 'user.pages_user', 'group' => 'shtt', 'label' => 'Sở hữu trí tuệ', 'icon' => '💡', 'subMenu' => [
                            ['route' => 'user.pages_user', 'group' => 'shttquytrinh', 'label' => 'Quy trình - quy định'],
                            ['route' => 'user.pages_user', 'group' => 'shttvanbanbieumau', 'label' => 'Văn bản biểu mẫu'],
                            ['route' => 'user.pages_user', 'group' => 'shttkehoachcongvan', 'label' => 'Kế hoạch/Công văn']
                        ]],
                        ['route' => 'user.pages_user', 'group' => 'vbpl', 'label' => 'VB pháp luật', 'icon' => '📘', 'subMenu' => [
                            ['route' => 'user.pages_user', 'group' => 'vanbanthanhtra', 'label' => 'VB thanh tra'],
                            ['route' => 'user.pages_user', 'group' => 'vanbanphapche', 'label' => 'VB pháp chế'],
                            ['route' => 'user.pages_user', 'group' => 'vanbansohuutritue', 'label' => 'VB SHTT'],
                            ['route' => 'user.pages_user', 'group' => 'vanbankhac', 'label' => 'VB khác']
                        ]],
                        ['route' => 'user.pages_user', 'group' => 'vbdhqg', 'label' => 'VB - ĐHQG', 'icon' => '🏛️', 'subMenu' => [
                            ['route' => 'user.pages_user', 'group' => 'dhqgvanbanthanhtra', 'label' => 'VB thanh tra'],
                            ['route' => 'user.pages_user', 'group' => 'dhqgvanbanphapche', 'label' => 'VB pháp chế'],
                            ['route' => 'user.pages_user', 'group' => 'dhqgvanbansohuutritue', 'label' => 'VB SHTT'],
                            ['route' => 'user.pages_user', 'group' => 'dhqgvanbankhac', 'label' => 'VB khác']
                        ]],
                    ]
                ];
            @endphp

            @foreach($navItems[Auth::user()->role] as $item)
                @if(isset($item['subMenu']))
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapse{{ $item['group'] }}" role="button">
                        {{ $item['icon'] }}<span>{{ $item['label'] }}</span> <span class="arrow-icon" id="arrow-{{ $item['group'] }}">&#9662;</span>
                    </a>
                    <div class="collapse ps-3" id="collapse{{ $item['group'] }}">
                        @foreach($item['subMenu'] as $sub)
                            <a class="nav-link" href="{{ route($item['route'], ['group' => $sub['group'], 'page' => 'index']) }}">📄 {{ $sub['label'] }}</a>
                        @endforeach
                    </div>
                @else
                    <a href="{{ route($item['route'], ['group' => $item['group'], 'page' => 'index']) }}" class="nav-link">{{ $item['icon'] }} <span>{{ $item['label'] }}</span></a>
                @endif
            @endforeach

        </nav>

        <div class="d-flex justify-content-end p-3">
            <form id="logout-form" action="{{ Auth::user()->role == 'admin' ? route('admin.logout') : route('user.logout') }}" method="POST" class="d-inline logout-form">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Đăng xuất</button>
            </form>
        </div>
    @endif
</div>
<script>
    document.querySelectorAll('.logout-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                event.preventDefault();
            }
        });
    });
</script>
