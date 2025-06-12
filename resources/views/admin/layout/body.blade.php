<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào mừng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .logo {
            width: 1000px;
            margin-bottom: 20px;
        }
        .title-admin {
            color: #0d6efd;
        }
        .title-user {
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="overlay text-center">
            <img src="{{ asset('storage/image/logolid.png') }}" alt="Logo AGU" class="logo">

            @if(Auth::check() && Auth::user()->role == 'admin')
                <h1 class="title-admin">Chào mừng bạn đến với Trang Quản trị</h1>
                <p class="mt-3">Bạn đã đăng nhập với vai trò <strong>Quản trị viên</strong>.</p>


            @elseif(Auth::check() && Auth::user()->role == 'user')
            
                <h1 class="title-user">Chào mừng bạn đến với Hệ thống</h1>
                <p class="mt-3">Bạn đã đăng nhập với vai trò <strong>ADMIN</strong>.</p>
            @endif
        </div>
    </div>
</body>
</html>
