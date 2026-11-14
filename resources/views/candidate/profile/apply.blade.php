@extends('layout.header')

@section('content')
<div class="apply-job-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card chính với hiệu ứng Shadow & Hover -->
                <div class="card apply-card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <!-- Sidebar trang trí (Tùy chọn) -->
                        <div class="col-md-4 bg-dark text-white p-5 d-flex flex-column justify-content-center gradient-custom">
                            <h3 class="fw-bold mb-3">Sẵn sàng bước tiếp?</h3>
                            <p class="small opacity-75">Cập nhật thông tin chính xác giúp bạn gia tăng 80% cơ hội được nhà tuyển dụng liên hệ.</p>
                            <div class="mt-4">
                                <div class="d-flex mb-3">
                                    <i class="bi bi-check-circle-fill me-2 text-success"></i>
                                    <span class="small">Thông tin bảo mật</span>
                                </div>
                                <div class="d-flex mb-3">
                                    <i class="bi bi-check-circle-fill me-2 text-success"></i>
                                    <span class="small">Phản hồi nhanh chóng</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form ứng tuyển -->
                        <div class="col-md-8 bg-white p-4 p-md-5">
                            <div class="form-header mb-4">
                                <h2 class="fw-bold text-dark mb-1">Ứng tuyển ngay</h2>
                                <p class="text-muted">Bạn đang ứng tuyển vị trí:</p>
                                <div class="job-badge p-3 rounded-3 bg-light border-start border-4 border-primary">
                                    <h5 class="fw-bold text-primary mb-0">{{ $job->job_title }}</h5>
                                </div>
                            </div>

                            <form action="{{ route('profile.storeApply', $job->job_id) }}" method="POST" id="applyForm">
                                @csrf

                                <!-- Thông tin cá nhân (Read-only) -->
                                <div class="row mb-4">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-label small text-uppercase fw-bold text-muted">Họ tên</label>
                                        <div class="p-2 border-bottom fw-semibold">{{ $candidate->full_name }}</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label small text-uppercase fw-bold text-muted">Số điện thoại</label>
                                        <div class="p-2 border-bottom fw-semibold">{{ $candidate->phone }}</div>
                                    </div>
                                </div>

                                <!-- Chọn CV -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold"><i class="bi bi-file-earmark-pdf me-2"></i>Chọn CV của bạn</label>
                                    <select name="resume_id" class="form-select custom-select py-2">
                                        <option value="" selected disabled>-- Chọn hồ sơ đã lưu --</option>
                                        @foreach($resumes as $resume)
                                            <option value="{{ $resume->resume_id }}">
                                                {{ $resume->resume_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-end">
                                        <a href="#" class="small text-decoration-none">+ Tạo CV mới</a>
                                    </div>
                                </div>

                                <!-- Link CV -->
                                <div class="mb-5">
                                    <label class="form-label fw-bold"><i class="bi bi-link-45deg me-2"></i>Hoặc Link CV online</label>
                                    <input type="text" name="resume_link" class="form-control py-2 custom-input" placeholder="Google Drive, Portfolio, LinkedIn...">
                                </div>

                                <!-- Nút Submit với hiệu ứng -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-apply py-3 fw-bold rounded-pill shadow">
                                        GỬI HỒ SƠ ỨNG TUYỂN <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-link text-muted text-decoration-none small mt-2">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-custom {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    }

    .apply-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 20px !important;
    }

    .custom-input, .custom-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .custom-input:focus, .custom-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-2px);
    }

    .btn-apply {
        background: #2563eb;
        border: none;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-apply:hover {
        background: #1d4ed8;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3) !important;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .apply-job-section {
        animation: fadeInUp 0.6s ease-out;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 90px !important;
    }

    .job-badge {
        background-color: #eff6ff !important;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<x-floating-ui />
@endsection