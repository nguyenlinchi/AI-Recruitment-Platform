@extends('layout.header')

@section('content')

<!-- Import Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #3b71e4;
        --secondary: #6a5af9;
        --accent: #ff9c08;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --bg-glass: rgba(255, 255, 255, 0.85);
        --transition: all 0.3s ease;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden; 
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0f4ff;
    }

    .auth-wrapper {
        height: 100vh; /* Full chiều cao màn hình */
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: radial-gradient(circle at 50% 50%, #f6f8ff 0%, #e9eeff 100%);
    }

    /* BLOBS */
    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.5;
        z-index: 1;
        animation: float-blob 20s infinite alternate ease-in-out;
    }
    .blob-1 { width: 400px; height: 400px; background: var(--primary); top: -50px; left: -50px; }
    .blob-2 { width: 350px; height: 350px; background: var(--secondary); bottom: -50px; right: -50px; }

    @keyframes float-blob {
        from { transform: translate(0, 0) scale(1); }
        to { transform: translate(50px, 50px) scale(1.1); }
    }

    /* CONTAINER TỐI ƯU KÍCH THƯỚC */
    .main-container {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 1100px;
        z-index: 10;
        padding: 0 20px;
    }

    /* LEFT CONTENT - Co giãn vừa phải */
    .auth-left {
        flex: 1;
        padding-right: 50px;
    }

    .auth-left h1 {
        font-size: 48px; /* Giảm nhẹ cỡ chữ */
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .auth-left p {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 30px;
    }

    .tag-container { display: flex; flex-direction: column; gap: 12px; }
    .tag {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        width: fit-content;
        font-size: 14px;
        border: 1px solid rgba(255,255,255,0.8);
    }
    .tag i { color: var(--primary); }

    .auth-right {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        margin-top:100px;
    }

    .login-card {
        width: 100%;
        max-width: 400px; 
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        padding: 30px;
        border-radius: 28px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.06);
        border: 1px solid rgba(255,255,255,0.5);
    }

    .login-header h2 { font-size: 24px; font-weight: 800; margin-bottom: 5px; }
    .login-header p { font-size: 14px; color: var(--text-muted); margin-bottom: 25px; }

    /* FORM GỌN GÀNG */
    .input-group-custom { position: relative; margin-bottom: 15px; }
    .input-group-custom input {
        width: 100%;
        padding: 14px 14px 14px 48px;
        border-radius: 14px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        outline: none;
        font-size: 14px;
        transition: var(--transition);
    }
    .input-group-custom i {
        position: absolute; left: 18px; top: 50%;
        transform: translateY(-50%); color: #94a3b8;
    }
    .input-group-custom input:focus { border-color: var(--primary); background: white; }

    .btn-submit {
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        border: none;
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        color: white; font-weight: 700;
        cursor: pointer; transition: var(--transition);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(59,113,228,0.3); }

    .social-divider { text-align: center; margin: 20px 0; position: relative; }
    .social-divider::before { content: ""; position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e2e8f0; }
    .social-divider span { position: relative; background: #fff; padding: 0 10px; font-size: 12px; color: var(--text-muted); }

    .social-btns { display: flex; gap: 10px; }
    .social-btn {
        flex: 1; padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0;
        background: white; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .auth-left { display: none; }
        .auth-right { justify-content: center; }
        html, body { overflow: auto; } /* Mobile cho phép cuộn nếu màn hình quá nhỏ */
    }
</style>

<div class="auth-wrapper">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="main-container">
        <!-- Trái -->
        <div class="auth-left">
            <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill">Smart AI Recruitment</span>
            <h1>Sẵn sàng cho <br> Bước tiến mới?</h1>
            <p>Hệ thống tuyển dụng thông minh giúp bạn tối ưu hóa hồ sơ và kết nối đúng nhà tuyển dụng phù hợp.</p>

            <div class="tag-container">
                <div class="tag"><i class="fa-solid fa-bolt"></i> Phân tích CV nhanh</div>
                <div class="tag"><i class="fa-solid fa-check-double"></i> Đề xuất việc làm chính xác</div>
            </div>
        </div>

        <!-- Phải -->
        <div class="auth-right">
            <div class="login-card">
                <div class="login-header text-center">
                    <h2>Đăng nhập</h2>
                    <p>Mừng bạn trở lại với hệ thống</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group-custom">
                        <input type="email" name="email" placeholder="Email của bạn" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="input-group-custom">
                        <input type="password" name="password" placeholder="Mật khẩu" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 px-1" style="font-size: 12px;">
                        <label class="d-flex align-items-center gap-2" style="cursor: pointer;">
                            <input type="checkbox" name="remember" class="form-check-input m-0"> 
                            <span class="text-muted">Ghi nhớ</span>
                        </label>
                        <a href="#" class="text-decoration-none fw-bold" style="color: var(--primary);">Quên mật khẩu?</a>
                    </div>

                    <button class="btn-submit" type="submit">Đăng nhập ngay</button>
                </form>

                <div class="social-divider"><span>Hoặc</span></div>

                <div class="social-btns">
                    <button class="social-btn"><img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" width="16"> Google</button>
                    <button class="social-btn"><i class="fa-brands fa-facebook" style="color: #1877f2;"></i> Facebook</button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small mb-0">Mới sử dụng? <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--accent);">Đăng ký</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection