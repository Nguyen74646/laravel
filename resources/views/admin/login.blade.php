<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị</title>
    <!-- Link Google Font (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* --- CSS Styles Enhanced --- */
        :root {
            --primary-color: #4a90e2; /* Màu xanh dương chủ đạo */
            --primary-darker: #357ABD;
            --background-color: #f7f9fc; /* Nền xám rất nhạt */
            --container-bg: #ffffff;
            --text-color: #333333;
            --label-color: #555555;
            --input-border: #ced4da;
            --input-focus-border: var(--primary-color);
            --error-bg: #fdeded; /* Nền hồng nhạt cho lỗi */
            --error-text: #a94442; /* Chữ đỏ sẫm */
            --error-border: #fcc;
        }

        body {
            font-family: 'Poppins', sans-serif; /* Sử dụng Poppins hoặc fallback */
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text-color);
        }
        .login-container {
            background-color: var(--container-bg);
            /* Tăng padding: 50px trên/dưới, 60px trái/phải */
            padding: 50px 10px;
            border-radius: 12px; /* Có thể tăng nhẹ nếu muốn bo tròn hơn với khung lớn */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* Tăng chiều rộng tối đa */
            max-width: 750px; /* Tăng chiều rộng tối đa */
            box-sizing: border-box;
            text-align: center;
        }

        .login-logo {
            width: 500px; /* <-- Tăng giá trị ở đây (ví dụ: 150px) */
            height: auto; /* Giữ nguyên auto để không làm méo ảnh */
            margin-bottom: 25px; /* Có thể điều chỉnh nếu cần thêm/bớt khoảng cách dưới */
        }

        h1 {
            font-size: 1.8rem; /* Cỡ chữ tiêu đề */
            font-weight: 600; /* Độ đậm vừa phải */
            color: var(--text-color);
            margin-bottom: 35px; /* Khoảng cách dưới tiêu đề */
        }

        .form-group {
            margin-bottom: 22px;
            text-align: left; /* Căn trái label và input */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500; /* Hơi đậm hơn mặc định */
            color: var(--label-color);
            font-size: 0.95rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px; /* Tăng padding */
            border: 1px solid var(--input-border);
            border-radius: 8px; /* Bo góc input */
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--input-focus-border);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2); /* Hiệu ứng glow nhẹ */
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background-image: linear-gradient(to right, var(--primary-color), var(--primary-darker)); /* Gradient nhẹ */
            background-color: var(--primary-color); /* Fallback */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease, box-shadow 0.3s ease;
            margin-top: 10px; /* Thêm khoảng cách trên nút */
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3); /* Đổ bóng cho nút */
        }

        button[type="submit"]:hover {
            background-image: linear-gradient(to right, var(--primary-darker), var(--primary-color));
            background-color: var(--primary-darker); /* Fallback */
            box-shadow: 0 6px 15px rgba(74, 144, 226, 0.4);
        }

        button[type="submit"]:active {
            transform: scale(0.98); /* Hiệu ứng nhấn nút */
            box-shadow: 0 2px 5px rgba(74, 144, 226, 0.2);
        }

        .error-message {
            background-color: var(--error-bg);
            color: var(--error-text);
            border: 1px solid var(--error-border);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 0.95rem;
        }
        /* --- End CSS --- */
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Sử dụng hàm asset để lấy đường dẫn chính xác -->
        <img src="{{ asset('storage/image/logolid.png') }}" alt="Logo Công ty" class="login-logo">

        <h1>Đăng nhập Hệ thống</h1>

        @if ($errors->any())
            <div class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16" style="vertical-align: -0.125em; margin-right: 5px;">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Địa chỉ Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Nhập email của bạn">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>

            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>