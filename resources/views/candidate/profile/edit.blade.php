<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Nền và khung tổng thể gọn gàng */
    .cv-body-bg {
        background-color: #f8fafc;
        min-height: 100vh;
    }
    .cv-card-modern {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    
    /* Header tinh tế, chữ trắng rõ ràng trên nền gradient */
    .cv-header-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        padding: 2rem !important;
    }

    /* Khối bọc từng hàng: Đảm bảo khoảng cách và hiển thị block rõ ràng */
    .cv-form-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.25s ease;
    }
    .cv-form-item:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    /* Ép label luôn nằm trên và thẳng hàng */
    .cv-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Đảm bảo input/textarea chiếm trọn 100% chiều rộng khối, không bị co nhỏ */
    .cv-input-field {
        width: 100% !important;
        display: block;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background-color: #f8fafc;
        padding: 12px 16px;
        color: #0f172a;
        font-size: 0.95rem;
        transition: border-color 0.2s, background-color 0.2s;
    }
    .cv-input-field:focus {
        background-color: #ffffff;
        border-color: #3b82f6;
        outline: none;
    }

    /* Nút bấm */
    .btn-cv-save {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-cv-save:hover {
        opacity: 0.95;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
</style>

<div class="cv-body-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <form action="{{ route('resume.update', $resume->resume_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card cv-card-modern overflow-hidden">
                        
                        <div class="card-header cv-header-gradient text-white border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-white text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; min-width: 48px;">
                                    <i class="bi bi-file-earmark-person-fill fs-3 text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-white">Cập Nhật Hồ Sơ Xin Việc</h4>
                                    <p class="mb-0 text-white-50 small">Chỉnh sửa thông tin để CV của bạn chuyên nghiệp và thu hút hơn</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            
                            <div class="cv-form-item mb-4" style="border-left: 4px solid #4f46e5;">
                                <label class="cv-label">
                                    <i class="bi bi-bookmark-star-fill text-primary"></i> Tên tiêu đề CV <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="resume_title" 
                                       class="cv-input-field fw-semibold" 
                                       value="{{ $resume->resume_title }}" 
                                       placeholder="Ví dụ: Lập trình viên PHP Laravel"
                                       required>
                            </div>

                            <div class="row g-4">
                                
                                <div class="col-12">
                                    <div class="cv-form-item">
                                        <label class="cv-label">
                                            <i class="bi bi-bullseye text-danger"></i> Mục tiêu nghề nghiệp
                                        </label>
                                        <textarea name="career_objective" 
                                                  class="cv-input-field" 
                                                  rows="3" 
                                                  placeholder="Tóm tắt ngắn gọn định hướng nghề nghiệp của bạn...">{{ $resume->career_objective }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cv-form-item h-100">
                                        <label class="cv-label">
                                            <i class="bi bi-briefcase text-primary"></i> Kinh nghiệm làm việc
                                        </label>
                                        <textarea name="experience" 
                                                  class="cv-input-field" 
                                                  rows="5" 
                                                  placeholder="• Vị trí - Tên công ty (Thời gian)&#10;• Mô tả ngắn gọn công việc chính...">{{ $resume->experience }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cv-form-item h-100">
                                        <label class="cv-label">
                                            <i class="bi bi-mortarboard text-success"></i> Học vấn / Bằng cấp
                                        </label>
                                        <textarea name="education" 
                                                  class="cv-input-field" 
                                                  rows="5" 
                                                  placeholder="• Chuyên ngành - Tên trường đào tạo&#10;• Điểm số hoặc bằng cấp liên quan...">{{ $resume->education }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cv-form-item h-100">
                                        <label class="cv-label">
                                            <i class="bi bi-diagram-3 text-warning"></i> Kỹ năng cá nhân & Mềm
                                        </label>
                                        <textarea name="soft_skills" 
                                                  class="cv-input-field" 
                                                  rows="4" 
                                                  placeholder="Ví dụ: Giao tiếp, Làm việc nhóm, Giải quyết vấn đề...">{{ $resume->soft_skills }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cv-form-item h-100">
                                        <label class="cv-label">
                                            <i class="bi bi-trophy text-info"></i> Giải thưởng & Chứng chỉ
                                        </label>
                                        <textarea name="awards" 
                                                  class="cv-input-field" 
                                                  rows="4" 
                                                  placeholder="Ví dụ: Chứng chỉ IELTS 7.0, Nhân viên xuất sắc...">{{ $resume->awards }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
                            <a href="{{ url()->previous() }}" class="btn btn-link text-muted text-decoration-none fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-cv-save shadow-sm">
                                <i class="bi bi-cloud-check-fill me-2"></i> Lưu & Cập nhật CV
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>