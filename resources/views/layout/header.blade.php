<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Hiring - Kết nối tài năng</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- của phẩn cv -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Project -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('styles')

    <style>

        :root{
            --primary-color:#2563eb;
            --hover-color:#1d4ed8;
            --text-main:#111827;
            --transition:all .3s ease;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#ffffff;
        }

        /* ================= NAVBAR ================= */

        .custom-navbar{
            position:fixed;

            top:18px;
            left:50%;

            transform:translateX(-50%);

            width:96%;
            height:82px;

            background: #f5f9ff;
            backdrop-filter:blur(18px);
            -webkit-backdrop-filter:blur(18px);
            border-radius:28px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 38px;
            z-index:999;
            border:1px solid rgba(255,255,255,0.6);
            box-shadow:
                    0 10px 35px rgba(0,0,0,0.06),
                    0 2px 10px rgba(0,0,0,0.03);

            transition:var(--transition);
        }

        .custom-navbar.scrolled{
            top:10px;
            height:74px;
        }


        .logo{
            display:flex;
            align-items:center;
            text-decoration:none;
        }

        .logo img{
            height:55px;
        }

        .logo-text{
            font-size:24px;
            font-weight:800;
            color:#2563eb;
            margin-left:10px;
        }

        /*  MENU ================= */

        .nav-links{
            display:flex;
            align-items:center;
            gap:42px;

            margin-left:-130px;
        }

        .nav-item{
            position:relative;
            text-decoration:none;

            color:#111827;

            font-size:16px;
            font-weight:600;

            padding:8px 0;

            transition:var(--transition);
        }

        .nav-item:hover{
            color:var(--primary-color);
        }

        .nav-item.active{
            color:var(--primary-color);
        }


        .nav-item::after{
            content:"";
            position:absolute;
            left:50%;
            bottom:-8px;
            transform:translateX(-50%);
            width:0;
            height:4px;

            border-radius:50px;

            background:linear-gradient(
                    to right,
                    #2563eb,
                    #60a5fa
            );

            transition:.3s;
        }

        .nav-item:hover::after{
            width:70%;
        }

        .nav-item.active::after{
            width:100%;
        }


        .auth-section{
            display:flex;
            align-items:center;
            gap:16px;
        }

        .btn-login{
            text-decoration:none;
            color:#2563eb;
            font-weight:700;
            transition:.3s;
        }

        .btn-login:hover{
            color:#1d4ed8;
        }

        .btn-register{
            height:52px;
            padding:0 28px;
            border-radius:18px;
            background:linear-gradient(
                    135deg,
                    #2563eb,
                    #3b82f6
            );

            color:white !important;
            text-decoration:none;
            font-weight:700;
            display:flex;
            align-items:center;
            justify-content:center;

            box-shadow:
                    0 10px 25px rgba(37,99,235,0.25);

            transition:.3s;
        }

        .btn-register:hover{
            transform:translateY(-3px);

            box-shadow:
                    0 16px 35px rgba(37,99,235,0.35);
        }


        .user-pill{
            display:flex;
            align-items:center;
            gap:12px;

            background:#f8fafc;
            border-radius:50px;
            padding:7px 8px 7px 16px;
            border:1px solid #e2e8f0;
        }

        .user-name{
            text-decoration:none;
            color:#111827;
            font-weight:700;
        }

        .btn-logout{
            width:36px;
            height:36px;
            border:none;
            border-radius:50%;
            background:white;
            color:#ef4444;
            cursor:pointer;
            transition:.3s;
        }

        .btn-logout:hover{
            background:#ef4444;
            color:white;
            transform:rotate(90deg);
        }


        @media(max-width:992px){

            .nav-links{
                display:none;
            }

            .custom-navbar{
                padding:0 20px;
            }

            .logo-text{
                font-size:20px;
            }

            .btn-register{
                height:45px;
                padding:0 18px;
                font-size:14px;
            }
        }

    </style>
</head>

<body>


<nav class="custom-navbar">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">

        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1778598486/logo-removebg-preview_aecyly.png"
             alt="Logo">

        <span class="logo-text">
            Hiring
        </span>

    </a>

    <!-- Menu -->
    <div class="nav-links">

        <a href="{{ route('home') }}"
           class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            Trang chủ
        </a>

        <a href="{{ route('jobs.index') }}"
           class="nav-item {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
            Việc làm
        </a>

        <a href="{{ route('cv.index') }}"
           class="nav-item {{ request()->routeIs('cv.index') ? 'active' : '' }}">
            CV
        </a>

        <a href="{{ route('career.index') }}"
           class="nav-item {{ request()->routeIs('career.index') ? 'active' : '' }}">
            Cẩm nang nghề nghiệp
        </a>

    </div>

    <!-- Auth -->
    <div class="auth-section">

        @guest

            <a href="{{ route('login') }}"
               class="btn-login">
                Đăng nhập
            </a>

            <a href="{{ route('register') }}"
               class="btn-register">
                Tham gia ngay
            </a>

        @else

            <div class="user-pill">

                <a href="{{ route('profile') }}"
                   class="user-name">

                    {{ Auth::user()->name }}

                </a>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="btn-logout">

                        <i class="fa-solid fa-arrow-right-from-bracket"></i>

                    </button>

                </form>

            </div>

        @endguest

    </div>

</nav>

<!-- ================= CONTENT ================= -->

<main>
    @yield('content')
</main>

<!-- ================= SCRIPTS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // Scroll navbar effect

    window.addEventListener("scroll", function(){

        const navbar = document.querySelector(".custom-navbar");

        if(window.scrollY > 20){
            navbar.classList.add("scrolled");
        }else{
            navbar.classList.remove("scrolled");
        }

    });

</script>

</body>

</html>