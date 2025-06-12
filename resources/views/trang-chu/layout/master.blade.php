<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

 <style>
        .header-top {
            background-color: #fff;
            padding: 10px 0;
            border-bottom: 3px solid #004AAD;
			with:100%;
			height:auto;
        }
        .header-top .logo {
            display: flex;
            align-items: center;
			
        }
        .header-top .logo img {
            height: 60px;
            margin-right: 10px;
        }
        .header-top .contact-info {
            text-align: right;
        }
        span.font-weight-bold {
            font-weight: bold;

            
        }
        .header-top a {
            text-decoration: none;
            color: #004AAD;
            font-weight: unset;
            
        }
        .header-top a:hover {
            text-decoration: underline;
           
            
        }
       
        .navbar {
            background-color: #050c9c !important;
        }
        .navbar-nav .nav-item .nav-link {
            color: white !important;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 15px;
        }
        .navbar-nav .nav-item .nav-link:hover {
            background-color: white;
            border-radius: 5px;
			color: #050c9c !important;
        }
        
        .navbar-nav .nav-item .dropdown-menu .dropdown-item{
            color: #050c9c; !important;
            font-size: 13px;
            font-weight: bold;
            padding: 10px 15px;
        }
        .navbar .dropdown-menu .dropdown-item:hover,
        .navbar .dropdown-menu .dropdown-item:focus { /* :focus cũng quan trọng cho accessibility */
        color: black;          /* Đổi màu chữ thành đen khi hover/focus */
        background-color: #e9ecef; 
        }

      
        .search-bar {
            position: absolute;
            right: 20px;
        }
        .search-bar input {
            border-radius: 20px;
            padding: 5px 10px;
        }

        .site-footer{
            background-color: #00008B;
            color: white;
            padding: 10px 0;
            font-size: 18px;


        }
        .site-footer a {
            color: white;
            text-decoration: none;
        }

        .site-footer ul a:hover {
            text-decoration: none;

           

        }
        .site-footer h6 {
            font-weight: bold; /* Làm đậm chữ */
            font-size: 20px;
            color: white; /* Đảm bảo chữ trắng nổi bật trên nền xanh */
            text-transform: uppercase; /* Viết hoa toàn bộ chữ */
            letter-spacing: 4px;

        }
        .site-footer a:hover {
            text-decoration: none;
            color:#00008B ;
            background-color: whitesmoke;
        }
        .site-footer .ttth {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: unset;
        }
        .site-footer .ttth:hover {
            color: yellow;
            background-color:#00008B;
            text-decoration: none;
        }
        .search-btn {
        background-color: #050c9c; /* Nền xanh giống header */
        border: 2px solid #ffffff; /* Viền trắng */
        color: #ffffff; /* Màu biểu tượng */
        transition: all 0.3s ease; /* Hiệu ứng chuyển đổi mượt */
    }

    .search-btn:hover {
        background-color: #ffffff; /* Nền trắng khi hover */
        color: #050c9c; /* Màu biểu tượng đổi thành xanh */
        border: 2px solid #050c9c; /* Viền xanh */
    }
    .card {
        border-radius: 10px;
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }
    

    </style>
</head>
<body>
	@include('trang-chu.layout.header')
    
    <main class="container mt-4">
        <div class="row">
			@yield('content')
        </div>
    </main>
    
	@include('trang-chu.layout.footer')
    <script src="https://kit.fontawesome.com/2038322d50.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>