<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Sidebar & Content */
     #sidebar {
        width: 250px;
        min-height: 100vh;
        transition: width 0.3s ease-in-out;
        position: fixed;
        z-index: 1040;
        background-color: #f8f9fa;
        overflow: hidden;
    }
    
    #sidebar.collapsed {
        width: 80px; /* Thu gọn sidebar */
    }
    
    #content-area {
        transition: margin-left 0.3s ease-in-out;
        margin-left: 250px; /* Mặc định có khoảng trống cho sidebar */
    }
    
    #content-area.full-width {
        margin-left: 80px; /* Khi sidebar thu gọn */
    }
    
    #showSidebarBtn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #333;
        padding: 0;
        margin-right: 10px; /* Đẩy nút cách chữ "Quản trị viên" */
    }
    .sidebar-header {
        padding: 15px;
        text-align: center;
        font-weight: bold;
        background-color: #e9ecef;
        border-bottom: 1px solid #dee2e6;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        position: relative;
        z-index: 1050;
    }

    #sidebar.collapsed .sidebar-header {
        width: 80px; /* Giữ nguyên chiều rộng chữ */
        left: 0; /* Đẩy chữ ra ngoài khi sidebar thu gọn */
        font-size: 0; /* Ẩn chữ khi sidebar thu gọn */
        text-align: center;
    }

    #sidebar.collapsed .sidebar-header {
        position: absolute;
        width: 250px; /* Giữ nguyên chiều rộng chữ */
        left: 80px; /* Đẩy chữ ra ngoài khi sidebar thu gọn */
        font-size: 16px; /* Giữ kích thước chữ */
        text-align: center;
    }

    .nav-link {
        font-size: 16px;
        padding: 10px 15px;
        transition: background-color 0.2s ease;
        color: #000 !important;         /* Màu chữ đen */
        font-weight: 600 !important; /* Chữ đậm */

    }
    .nav-link:hover {
        background-color: #f0f0f0;
        border-radius: 5px;
        color: #000 !important;
    }
    .arrow-icon.rotate {
        transform: rotate(180deg);
    }

    .collapse .nav-link {
        font-size: 15px;
        padding-left: 25px;
        font-weight: 600 !important;    /* In đậm luôn phần con */
        color: #000 !important;
    }

    #sidebar.collapsed .nav-link {
        justify-content: center;
        gap: 0;
    }

    #sidebar.collapsed .nav-link span {
        display: none; /* Ẩn chữ khi sidebar thu gọn */
    }

    .arrow-icon {
        transition: transform 0.3s ease;
        font-size: 1.2rem;
    }

    .arrow-icon.rotate {
        transform: rotate(180deg);
    }

    .blink-box:hover {
        background-color: #f8f9fa;
    }


</style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<body>
    @include('admin.layout.header')
    <!-- Main Content -->
    <div id="content-area" class="flex-grow-1 p-4">
        @yield('content')
    </div>
</div>
<script>
    function handleCollapseToggle(id) {
        const collapse = document.getElementById(id);
        const arrow = document.getElementById("arrow-" + id.toLowerCase());

        collapse.addEventListener('shown.bs.collapse', function () {
            arrow.classList.add('rotate');
        });

        collapse.addEventListener('hidden.bs.collapse', function () {
            arrow.classList.remove('rotate');
        });
    }

    // Gọi cho từng mục
    handleCollapseToggle('baiviet');
    handleCollapseToggle('ThanhTra');
    handleCollapseToggle('PhapChe');
    handleCollapseToggle('SHTT');
    handleCollapseToggle('VBPL');
    handleCollapseToggle('VBĐHQG');
</script>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content-area');
        const toggleButton = document.getElementById('showSidebarBtn');

        if (sidebar.classList.contains('collapsed')) {
            // Mở rộng sidebar
            sidebar.classList.remove('collapsed');
            content.classList.remove('full-width');
            toggleButton.innerHTML = '☰'; // Đổi biểu tượng về mặc định
        } else {
            // Thu gọn sidebar
            sidebar.classList.add('collapsed');
            content.classList.add('full-width');
            toggleButton.innerHTML = '☰'; // Giữ biểu tượng khi thu gọn
        }
    }
</script>
{{-- ckeditor --}}


@push('scripts')
    {{-- Tùy chọn 2: Sử dụng phiên bản hiện tại và ẩn thông báo --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('content')) {
                CKEDITOR.replace('content', {
                    height: 300,
                    language: 'vi',

                    // Tùy chỉnh thanh công cụ để gọn gàng hơn
                    toolbar: [
                        { name: 'document', items: [ 'Source' ] },
                        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
                        '/', // Xuống dòng mới trên toolbar
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
                        '/', // Xuống dòng mới
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
                    ],
                });

                // Chỉ thêm CSS để ẩn thông báo nếu bạn KHÔNG nâng cấp lên phiên bản LTS
                // Đoạn này sẽ chạy vì bạn đang dùng 4.22.1
                var cdnUrlElement = document.querySelector('script[src*="cdn.ckeditor.com"]');
                if (cdnUrlElement) { // Kiểm tra xem phần tử có tồn tại không
                    var cdnUrl = cdnUrlElement.src;
                    if (!cdnUrl.includes('4.25.1-lts')) { // Kiểm tra nếu không phải phiên bản LTS mới nhất
                        var style = document.createElement('style');
                        style.type = 'text/css';
                        style.innerHTML = '.cke_notifications_area { display: none !important; }';
                        document.getElementsByTagName('head')[0].appendChild(style);
                    }
                }

            } else {
                console.error("CKEditor: Không tìm thấy textarea với ID 'content'.");
            }
        });
    </script>
@endpush
</body>
</html>
