<!DOCTYPE html>
<html>
    
<head>
    <title>Employer Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            margin: 0;
            background: #f4f5fa;
            font-family: Arial, sans-serif;
        }

        /*TOPBAR*/
        .topbar {
            height: 75px;

            background: rgba(255, 255, 255, 0.95);

            margin-left: 270px;
            margin-top: 15px;
            margin-right: 20px;

            padding: 0 30px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-radius: 20px;

            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);

            backdrop-filter: blur(10px);

            position: sticky;
            top: 10px;
            z-index: 1000;
        }

        /* LEFT */
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 700;
            color: #23294a;
            margin: 0;
        }

        .topbar-subtitle {
            font-size: 13px;
            color: #888;
            margin-top: 2px;
        }

        /* SEARCH */
        .topbar-search {
            position: relative;
        }

        .topbar-search input {
            width: 280px;
            height: 42px;
            border-radius: 30px;
            border: 1px solid #e4e7f2;
            padding-left: 42px;
            padding-right: 15px;
            outline: none;
            transition: 0.3s;
        }

        .topbar-search input:focus {
            border-color: #4cc9f0;
            box-shadow: 0 0 0 3px rgba(76, 201, 240, 0.1);
        }

        .topbar-search i {
            position: absolute;
            left: 15px;
            top: 13px;
            color: #888;
        }

        /* RIGHT */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* ICON BUTTON */
        .top-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f5f7fb;

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;

            cursor: pointer;
            transition: 0.3s;
        }

        .top-icon:hover {
            background: #4cc9f0;
            color: #fff;
        }

        .top-icon .badge-dot {
            position: absolute;
            top: 8px;
            right: 8px;

            width: 10px;
            height: 10px;

            background: #ff3f6c;
            border-radius: 50%;
        }

        /* PROFILE */
        .top-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-profile img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4cc9f0;
        }

        .top-profile-info h6 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #23294a;
        }

        .top-profile-info p {
            margin: 0;
            font-size: 12px;
            color: #888;
        }

        /* SIDEBAR */
        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            height: calc(100vh - 20px);

            position: fixed;
            left: 10px;
            top: 10px;

            background: #23294a;

            border-radius: 25px;

            transition: 0.3s ease;

            overflow: hidden;

            z-index: 2000;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* COLLAPSE */
        .sidebar.collapsed {
            width: 90px;
        }

        /* PROFILE */
        .sidebar-profile {
            text-align: center;

            padding: 70px 15px 30px;

            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-profile img {
            width: 85px;
            height: 85px;

            border-radius: 50%;
            object-fit: cover;

            border: 4px solid rgba(255, 255, 255, 0.15);

            transition: 0.3s;
        }

        .sidebar-profile h5 {
            color: #fff;
            margin-top: 15px;
            font-size: 18px;
            transition: 0.3s;
        }

        .sidebar-profile p {
            color: #bfc5e0;
            font-size: 13px;
            transition: 0.3s;
        }

        /* MENU */
        .sidebar-menu {
            padding-top: 15px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;

            gap: 15px;

            padding: 15px 25px;

            color: #bfc5e0;
            text-decoration: none;

            transition: 0.3s;

            position: relative;

            white-space: nowrap;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;

            border-left: 4px solid #4cc9f0;
        }

        /* TEXT HIDE */
        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .sidebar-profile h5,
        .sidebar.collapsed .sidebar-profile p,
        .sidebar.collapsed .menu-badge {
            display: none;
        }

        /* SMALL PROFILE */
        .sidebar.collapsed .sidebar-profile img {
            width: 50px;
            height: 50px;
        }

        /* TOGGLE BUTTON */
        .toggle-btn {
            position: absolute;

            top: 15px;
            right: 15px;

            width: 38px;
            height: 38px;

            border-radius: 12px;

            background: rgba(255, 255, 255, 0.08);

            color: #fff;

            border: none;

            cursor: pointer;

            transition: 0.3s;

            z-index: 1000;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar.collapsed .toggle-btn {
            right: 50%;
            transform: translateX(50%);
        }

        .toggle-btn:hover {
            background: #4cc9f0;
        }

        /* BADGE */
        .menu-badge {
            margin-left: auto;

            background: #00d2d3;

            color: #fff;

            font-size: 11px;

            padding: 3px 8px;

            border-radius: 20px;
        }

        /* TOPBAR
        .topbar {
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 15px 25px;
            margin-left: 250px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }*/

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 25px;
        }

        /* CARD */
        .card-box {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* COLLAPSED CONTENT */
        .sidebar.collapsed~.topbar,
        .sidebar.collapsed~.content {
            margin-left: 110px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <!-- TOGGLE -->
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </button>

        <!-- PROFILE -->
        <div class="sidebar-profile">

            @if (auth()->user()->employer && auth()->user()->employer->avatar)
                <img src="{{ auth()->user()->employer->avatar }}">
            @else
                <img src="https://via.placeholder.com/90">
            @endif

            <h5>
                {{ auth()->user()->employer->company_name ?? 'Employer' }}
            </h5>

            <p>{{ auth()->user()->email }}</p>

        </div>

        <!-- MENU -->
        <div class="sidebar-menu">

            <a href="/employer/dashboard" class="{{ request()->is('employer/dashboard') ? 'active' : '' }}">

                <i class="fa fa-chart-line"></i>

                <span class="menu-text">
                    Dashboard
                </span>

            </a>

            <a href="/employer/jobs" class="{{ request()->is('employer/jobs*') ? 'active' : '' }}">

                <i class="fa fa-briefcase"></i>

                <span class="menu-text">
                    Jobs
                </span>

            </a>

            <a href="/employer/applications" class="{{ request()->is('employer/applications*') ? 'active' : '' }}">

                <i class="fa fa-users"></i>

                <span class="menu-text">
                    Applications
                </span>


            </a>

            <a href="/employer/profile" class="{{ request()->is('employer/profile*') ? 'active' : '' }}">

                <i class="fa fa-building"></i>

                <span class="menu-text">
                    Profile
                </span>

            </a>
            <div class="logout">
            <a href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

        </div>

    </div>

    <!-- TOPBAR -->
    <div class="topbar">

        <!-- LEFT -->
        <div class="topbar-left">

            <div>
                <h4 class="topbar-title">

                    @if (request()->is('employer/dashboard'))
                        Dashboard
                    @elseif(request()->is('employer/jobs*'))
                        Jobs Management
                    @elseif(request()->is('employer/applications*'))
                        Applications Management
                    @elseif(request()->is('employer/profile*'))
                        Company Profile
                    @else
                        Employer Dashboard
                    @endif

                </h4>

                <div class="topbar-subtitle">

                    @if (request()->is('employer/dashboard'))
                        Welcome back 👋
                    @elseif(request()->is('employer/jobs*'))
                        Manage your recruitment posts
                    @elseif(request()->is('employer/applications*'))
                        Review candidate applications
                    @elseif(request()->is('employer/profile*'))
                        Update employer information
                    @endif

                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="topbar-right">

            <!-- SEARCH -->
            <!--<div class="topbar-search">
                <i class="fa fa-search"></i>

                <input type="text" placeholder="Search jobs...">
            </div>-->

            <!-- NOTIFICATION -->
            <div class="top-icon">
                <i class="fa fa-bell"></i>

                <span class="badge-dot"></span>
            </div>

            <!-- MESSAGE -->
            <div class="top-icon">
                <i class="fa fa-envelope"></i>
            </div>

            <!-- PROFILE -->
            <div class="top-profile">

                @if (auth()->user()->employer && auth()->user()->employer->avatar)
                    <img src="{{ auth()->user()->employer->avatar }}">
                @else
                    <img src="https://via.placeholder.com/45">
                @endif

                <div class="top-profile-info">

                    <!-- <h6>
                        {{ auth()->user()->name }}
                        {{ auth()->user()->employer->company_name ?? 'Employer' }}
                    </h6> -->
                    <h6>
                        {{
                            collect(explode(' ', auth()->user()->employer->company_name ?? 'Employer'))
                                ->take(-1)
                                ->implode(' ')
                        }}
                    </h6>

                    <p>
                        Employer
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .toggle('collapsed');

        }
    </script>
</body>

</html>
