@extends('layout.header')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #3b71e4;
        --secondary: #6a5af9;
        --accent: #ff9c08;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --bg-glass: rgba(255, 255, 255, 0.75);
    }

    /* KHÔNG CHO CUỘN TRANG */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* NỀN ĐỘNG VỚI CÁC KHỐI BLOB */
    .auth-wrapper {
        height: calc(100vh - 70px);
        margin-top: 70px;
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: #f8faff;
        overflow: hidden;
    }

    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.5;
        z-index: 1;
        animation: float 20s infinite alternate ease-in-out;
    }
    .blob-1 { width: 500px; height: 500px; background: var(--primary); top: -100px; left: -100px; }
    .blob-2 { width: 400px; height: 400px; background: var(--secondary); bottom: -100px; right: -100px; animation-delay: -5s; }
    .blob-3 { width: 300px; height: 300px; background: #e0e7ff; top: 20%; right: 20%; animation-delay: -10s; }

    @keyframes float {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(60px, 40px) scale(1.1); }
    }

    .main-container {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 1250px;
        z-index: 10;
        padding: 0 40px;
    }

    /* HIỆU ỨNG CHỮ BÊN TRÁI */
    .auth-left {
        flex: 1;
        padding-right: 60px;
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .auth-left h1 {
        font-size: clamp(36px, 4.5vw, 56px);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .auth-left p {
        font-size: 18px;
        color: var(--text-muted);
        margin-bottom: 30px;
        max-width: 480px;
        line-height: 1.6;
    }

    .tag-container { display: flex; flex-direction: column; gap: 15px; }
    .tag {
        display: flex;
        align-items: center; gap: 12px; padding: 12px 20px;
        background: white; border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        width: fit-content; font-size: 15px; font-weight: 600;
        color: var(--text-main);
        border: 1px solid rgba(255,255,255,1);
        transition: 0.3s;
    }
    .tag:hover { transform: translateX(10px); color: var(--primary); }
    .tag i { color: var(--primary); font-size: 18px; }

    /* CARD BÊN PHẢI - GLASSMORPHISM */
    .auth-right {
        flex: 1.4;
        display: flex;
        justify-content: flex-end;
        animation: slideInRight 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .register-card {
        width: 100%;
        max-width: 600px;
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 35px 45px;
        border-radius: 30px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: transform 0.3s ease;
    }
    
    .register-card:hover { transform: translateY(-5px); }

    .register-header h2 { font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 5px; }
    .register-header p { font-size: 14px; color: var(--text-muted); margin-bottom: 25px; }

    /* INPUT STYLING */
    .form-row { display: flex; gap: 20px; margin-bottom: 15px; }
    .form-col { flex: 1; }

    .input-group-custom { position: relative; margin-bottom: 15px; }
    .input-group-custom label {
        display: block; font-size: 13px; font-weight: 700;
        margin-bottom: 6px; margin-left: 5px; color: var(--text-main);
    }
    .input-group-custom input, .input-group-custom select {
        width: 100%;
        padding: 12px 12px 12px 48px;
        border-radius: 15px;
        border: 2px solid #eef2f6;
        background: rgba(255, 255, 255, 0.9);
        outline: none;
        font-size: 14.5px;
        transition: 0.3s ease;
    }
    .input-group-custom i {
        position: absolute; left: 18px; bottom: 15px;
        color: #94a3b8; font-size: 16px; transition: 0.3s;
    }
    .input-group-custom input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(59, 113, 228, 0.1);
        background: white;
    }
    .input-group-custom input:focus + i { color: var(--primary); }

    /* NÚT BẤM CÓ HIỆU ỨNG GLOW */
    .btn-submit {
        width: 100%;
        padding: 15px;
        border-radius: 15px;
        border: none;
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        color: white; font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(59, 113, 228, 0.2);
        margin-top: 10px;
    }
    .btn-submit:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 30px rgba(59, 113, 228, 0.4);
    }

    .login-link { text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-muted); }
    .login-link a { color: var(--primary); text-decoration: none; font-weight: 700; transition: 0.3s; }
    .login-link a:hover { text-decoration: underline; }

    /* ANIMATIONS KEYFRAMES */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(60px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* RESPONSIVE LỚP NHỎ */
    @media (max-height: 720px) {
        .register-card { padding: 20px 40px; }
        .input-group-custom { margin-bottom: 10px; }
        .register-header { margin-bottom: 15px; }
    }
</style>

<div class="auth-wrapper">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="main-container">
        <div class="auth-left">
            <span class="badge" style="background: var(--primary); color: white; padding: 6px 15px; border-radius: 30px; font-size: 11px; font-weight: 700; margin-bottom: 20px; display: inline-block; letter-spacing: 1px;">GIA NHẬP MẠNG LƯỚI AI</span>
            <h1>Khởi đầu <br>Sự nghiệp AI</h1>
            <p>Hệ thống hỗ trợ phân tích kỹ năng và kết nối bạn với những cơ hội tốt nhất trong ngành Công nghệ cao.</p>

            <div class="tag-container">
                <div class="tag"><i class="fa-solid fa-circle-check"></i> Phân tích kỹ năng bằng AI</div>
                <div class="tag"><i class="fa-solid fa-rocket"></i> Kết nối việc làm ngay lập tức</div>
            </div>
        </div>

        <div class="auth-right">
            <div class="register-card">
                <div class="register-header text-center">
                    <h2>Tạo tài khoản</h2>
                    <p>Điền thông tin bên dưới để bắt đầu hành trình của bạn</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-row">
                        <div class="input-group-custom form-col">
                            <label>Họ và Tên</label>
                            <input type="text" name="name" placeholder="Ví dụ: Võ Thị Thu" required>
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="input-group-custom form-col">
                            <label>Email công việc</label>
                            <input type="email" name="email" placeholder="example@vku.udn.vn" required>
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group-custom form-col">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" placeholder="••••••••" required>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="input-group-custom form-col">
                            <label>Xác nhận</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" required>
                            <i class="fa-solid fa-shield-check"></i>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>Vai trò của bạn</label>
                        <select name="role">
                            <option value="CANDIDATE">Ứng viên (Đang tìm kiếm cơ hội)</option>
                            <option value="EMPLOYER">Nhà tuyển dụng (Đang tìm nhân tài)</option>
                        </select>
                        <i class="fa-solid fa-briefcase"></i>
                    </div>

                    <button class="btn-submit" type="submit">Đăng ký ngay bây giờ</button>
                </form>

                <div class="login-link">
                    Đã có tài khoản? <a href="/login">Đăng nhập ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection