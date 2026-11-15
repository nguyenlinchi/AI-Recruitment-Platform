@extends('layout.employer')

@section('content')
<!-- Nhúng Google Font & FontAwesome nếu layout mẹ chưa có -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    .main-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: #adb5bd;
        font-size: 12px;
    }
    .custom-badge {
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
    }
    .info-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #8c98a5;
    }
    .info-value {
        font-weight: 500;
        color: #2d3748;
    }
    .avatar-wrapper {
        position: relative;
        display: inline-block;
    }
    .status-indicator {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 16px;
        height: 16px;
        border: 3px solid #fff;
        border-radius: 50%;
    }
</style>

<div class="container py-4 main-container">
    
    <!-- BREADCRUMB (ĐƯỜNG DẪN ĐIỀU HƯỚNG) -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0 m-0 align-items-center">
            <li class="breadcrumb-item">
                <a href="/employer/applications" class="text-decoration-none text-muted font-medium">Quản lý ứng viên</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Chi tiết ứng viên</li>
        </ol>
    </nav>

    <!-- MAIN CARD -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
        
        <!-- CARD HEADER -->
        <div class="card-header bg-white border-bottom border-light py-4 px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 bg-light rounded-3 text-primary">
                    <i class="fa-solid fa-id-card fs-5"></i>
                </div>
                <h4 class="mb-0 fw-bold text-dark fs-5">Hồ sơ chi tiết ứng viên</h4>
            </div>

            <!-- Khối Badge Trạng Thái Bo Tròn Hiện Đại -->
            @if($app->status == 0)
                <span class="custom-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                    <i class="fa-solid fa-spinner me-1fa-spin"></i> Chờ duyệt
                </span>
            @elseif($app->status == 1)
                <span class="custom-badge bg-success bg-opacity-10 text-success border border-success border-opacity-20">
                    <i class="fa-solid fa-circle-check me-1"></i> Đã duyệt
                </span>
            @else
                <span class="custom-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20">
                    <i class="fa-solid fa-circle-xmark me-1"></i> Từ chối
                </span>
            @endif
        </div>

        <!-- CARD BODY -->
        <div class="card-body p-4">
            <div class="row g-4">

                <!-- LEFT COLUMN: AVATAR & QUICK INFO -->
                <div class="col-lg-4 text-center border-end border-light py-3">
                    <div class="avatar-wrapper mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($app->candidate->full_name) }}&background=6c5ce7&color=fff&size=120"
                             class="rounded-circle shadow-sm border border-3 border-light"
                             width="120" height="120" alt="Avatar">
                        @if($app->status == 1)
                            <div class="status-indicator bg-success"></div>
                        @elseif($app->status == 2)
                            <div class="status-indicator bg-danger"></div>
                        @else
                            <div class="status-indicator bg-warning"></div>
                        @endif
                    </div>

                    <h4 class="fw-bold text-dark mb-2">{{ $app->candidate->full_name }}</h4>
                    
                    <div class="p-3 bg-light rounded-3 inline-block mx-auto mb-2" style="max-width: 90%;">
                        <span class="text-muted d-block small mb-1">Vị trí ứng tuyển</span>
                        <strong class="text-primary text-uppercase fs-6">{{ $app->job->job_title }}</strong>
                    </div>
                </div>

                <!-- RIGHT COLUMN: DETAILED INFO & ACTION -->
                <div class="col-lg-8 ps-lg-4">

                    <!-- Section 1: Thông tin liên hệ -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light d-flex align-items-center gap-2">
                            <i class="fa-solid fa-user-gear text-secondary fs-6"></i> Thông tin cơ bản
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3">
                                    <label class="info-label d-block mb-1">Địa chỉ Email</label>
                                    <div class="info-value text-break">
                                        <i class="fa-regular fa-envelope me-2 text-muted"></i>{{ $app->candidate->account->email ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3">
                                    <label class="info-label d-block mb-1">Ngày nộp đơn</label>
                                    <div class="info-value">
                                        <i class="fa-regular fa-calendar-days me-2 text-muted"></i>{{ date('d/m/Y', strtotime($app->applied_date)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Tài liệu đính kèm (CV) -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light d-flex align-items-center gap-2">
                            <i class="fa-solid fa-paperclip text-secondary fs-6"></i> Tài liệu đính kèm
                        </h5>
                        
                        <div class="p-3 border rounded-3 d-flex align-items-center justify-content-between bg-light bg-opacity-50">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 bg-danger bg-opacity-10 text-danger rounded-2">
                                    <i class="fa-solid fa-file-pdf fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold text-dark small">Hồ sơ năng lực (CV_Candidate)</p>
                                    <span class="text-muted small">Định dạng file PDF/Word</span>
                                </div>
                            </div>
                            <a href="{{ $app->resume_link }}"
                               target="_blank"
                               class="btn btn-white border shadow-sm btn-sm px-3 rounded-2 fw-semibold text-primary hover-elevate">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Xem trực tuyến
                            </a>
                        </div>
                    </div>

                    <!-- Section 3: Cập nhật trạng thái xử lý hồ sơ -->
                    <div class="p-4 bg-light rounded-4 border border-light">
                        <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="fa-solid fa-sliders text-secondary fs-6"></i> Tiến trình phê duyệt hồ sơ
                        </h5>

                        <form method="POST" action="/employer/applications/{{ $app->application_id }}/status">
                            @csrf
                            <div class="row g-3 align-items-end">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-secondary">Thay đổi trạng thái ứng viên</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-bars-progress text-muted"></i></span>
                                        <select name="status" class="form-select border-start-0 ps-0 fw-semibold text-dark">
                                            <option value="0" {{ $app->status == 0 ? 'selected' : '' }}>⏳ Chờ duyệt hồ sơ</option>
                                            <option value="1" {{ $app->status == 1 ? 'selected' : '' }}>✅ Tiếp nhận / Duyệt</option>
                                            <option value="2" {{ $app->status == 2 ? 'selected' : '' }}>❌ Từ chối hồ sơ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <button class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        <span>Cập nhật kết quả</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection