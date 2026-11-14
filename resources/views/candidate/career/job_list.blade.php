@extends('layout.header')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary-blue: #2563eb;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
    }

    body { background-color: var(--light-bg); font-family: 'Inter', sans-serif; }

    .main-wrapper { padding-top: 100px; padding-bottom: 50px; }

    .filter-sidebar { background: white; border-radius: 12px; padding: 20px; border: 1px solid var(--border-color); }
    .filter-title { font-weight: 700; font-size: 0.9rem; letter-spacing: 1px; color: #64748b; text-transform: uppercase; margin-bottom: 20px; }
    .filter-group-title { font-weight: 600; margin-bottom: 12px; font-size: 0.95rem; }
    .form-check-label { font-size: 0.9rem; color: #475569; }

    .stat-card { background: white; border-radius: 12px; padding: 15px; border: 1px solid var(--border-color); display: flex; align-items: center; transition: 0.3s; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .stat-icon { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 1.2rem; }

    .job-card { background: white; border-radius: 16px; border: 1px solid var(--border-color); transition: all 0.3s ease; overflow: hidden; position: relative; }
    .job-card:hover { border-color: var(--primary-blue); box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    
    .company-logo-wrapper { width: 80px; height: 80px; border: 1px solid #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; padding: 10px; }
    .match-percent { color: #10b981; font-weight: 700; background: #ecfdf5; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; }
    
    .job-tag { background: #f1f5f9; color: #64748b; font-size: 0.75rem; padding: 4px 12px; border-radius: 6px; font-weight: 500; }
    .why-match-box { background: #f8fafc; border-radius: 12px; padding: 15px; font-size: 0.85rem; height: 100%; border-left: 3px solid #10b981; }
    
    .btn-save { border: 1px solid var(--border-color); color: #64748b; transition: 0.3s; }
    .btn-save:hover { background: #f1f5f9; color: var(--primary-blue); }

    
    .animate-delay-1 { animation-delay: 0.1s; }
    .animate-delay-2 { animation-delay: 0.2s; }
    <style>

.save-job-btn.saved{
    background:#2563eb;
    color: #f80f36;
    border:none;
}

.save-job-btn.saved i{
    color: #f80f36;
}


</style>

<div class="main-wrapper">
    <div class="container-fluid px-lg-5">
        <div class="row">
            
            <div class="col-lg-2 animate__animated animate__fadeInLeft">
                <div style="margin-top: 120px;" class="d-none d-lg-block"></div>
                
                <div class="filter-sidebar">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="filter-title">BỘ LỌC</span>
                        <a href="#" class="text-decoration-none small text-muted"><i class="bi bi-arrow-clockwise"></i> Xóa lọc</a>
                    </div>

                    <div class="mb-4">
                        <p class="filter-group-title">Mức lương</p>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" checked id="sal-all">
                            <label class="form-check-label" for="sal-all">Tất cả</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="sal-1">
                            <label class="form-check-label" for="sal-1">Dưới 10 triệu</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="filter-group-title">Địa điểm</p>
                        <select class="form-select form-select-sm border-light bg-light">
                            <option selected>Tất cả địa điểm</option>
                            <option>Đà Nẵng</option>
                            <option>Hà Nội</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                
                <div class="d-flex justify-content-between align-items-start mb-4 animate__animated animate__fadeIn">
                    <div>
                        <h2 class="fw-bold mb-1">Việc làm gợi ý cho bạn</h2>
                        <p class="text-muted">Dựa trên tính cách của bạn, chúng tôi gợi ý những công việc phù hợp nhất.</p>
                    </div>
                </div>

                <div class="row g-3 mb-4 animate__animated animate__fadeInUp animate-delay-1">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $jobs->total() }}</h5>
                                <p class="mb-0 small text-muted">Việc làm phù hợp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-bullseye"></i></div>
                            <div>
                                <h5 class="mb-0 fw-bold"> {{ $topMatch->match_percent ?? 0 }}%</h5>
                                <p class="mb-0 small text-muted">Công việc phù hợp nhất</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-star"></i></div>
                            <div>
                                <p class="mb-0 small fw-bold">Tính cách của bạn: <span class="text-primary text-uppercase">{{ $keyword ?? 'INFP' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse($jobs as $key => $job)
                    <div class="col-12 mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ 0.2 + ($key * 0.1) }}s">
                        <div class="job-card p-4">
                            <div class="row g-4">
                                <div class="col-md-5 border-end">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="company-logo-wrapper me-3">
                                            <img src="{{ $job->employer->avatar}}" class="img-fluid" alt="logo">
                                        </div>
                                        <div>
                                            <h4 class="fw-bold mb-1 fs-5 text-primary">{{ $job->job_title }}</h4>
                                            <p class="mb-1 fw-medium text-dark">{{ $job->employer->company_name ?? 'Công ty ẩn danh' }} <i class="bi bi-patch-check-fill text-primary ms-1"></i></p>
                                            <div class="text-muted small">
                                                <span class="me-3"><i class="bi bi-geo-alt me-1"></i>{{ $job->location->location_name }}</span>
                                                <span><i class="bi bi-clock me-1"></i>Toàn thời gian</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        <span class="job-tag">{{ $job->candidate_requirements }}</span>
                                        <span class="job-tag">Tư duy hệ thống</span>
                                    </div>
                                    <p class="mt-3 text-muted small text-truncate-2">
                                        {{ $job->job_description}} 
                                    </p>
                                </div>

                                
                                <div class="col-md-3 border-end d-flex flex-column justify-content-center px-lg-4">
                                    <div class="mb-3">
                                        <span class="match-percent"><i class="bi bi-stars me-1"></i> {{ $job->match_percent }}%</span>
                                    </div>
                                    <h4 class="text-success fw-bold mb-1 fs-5">{{ $job->salary->salary_range ?? '12 - 18 triệu' }}</h4>
                                    <p class="text-muted small mb-0">Đăng 2 ngày trước</p>
                                </div>

                                
                                <div class="col-md-4 d-flex flex-column justify-content-between">
                                    <div class="why-match-box">
                                        <p class="fw-bold mb-2 small text-dark">Vì sao phù hợp?</p>
                                        <ul class="list-unstyled mb-0 small text-muted">
                                            <li class="mb-1"><i class="bi bi-check2 text-success me-2"></i>Bạn có xu hướng sáng tạo cao</li>
                                            <li class="mb-1"><i class="bi bi-check2 text-success me-2"></i>Phù hợp với môi trường linh hoạt</li>
                                            <li><i class="bi bi-check2 text-success me-2"></i>Quan tâm đến trải nghiệm con người</li>
                                        </ul>
                                    </div>
                                    <div class="d-flex gap-2 mt-3">
                                        <button
                                            class="btn btn-save px-3 rounded-pill flex-grow-1 save-job-btn
                                            {{ in_array($job->job_id, $savedJobIds ?? []) ? 'saved' : '' }}"
                                            
                                            data-job-id="{{ $job->job_id }}"
                                        >

                                            @if(in_array($job->job_id, $savedJobIds ?? []))
                                                <i class="fa-solid fa-heart me-1"></i>
                                            @else
                                                <i class="fa-regular fa-heart me-1"></i>
                                            @endif

                                            Lưu
                                        </button>                                        
                                        <a href="{{ route('jobs.show', $job->job_id) }}" class="btn btn-primary px-4 rounded-pill flex-grow-1 fw-bold">Xem chi tiết <i class="bi bi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    
                    @endforelse
                </div>

                
                <div class="mt-4">
                    {{ $jobs->appends(['keyword' => $keyword])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("click", function (e) {

    const button = e.target.closest(".save-job-btn");

    if (!button) return;

    e.preventDefault();

    let jobId = button.dataset.jobId;

    let icon = button.querySelector("i");

    fetch("/save-job/" + jobId, {

        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),

            "Content-Type": "application/json",
            "Accept": "application/json"
        }

    })

    .then(response => response.json())

    .then(data => {

        console.log(data);

        // THẢ TIM
        if (data.status === "saved") {

            button.classList.add("saved");

            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");

        }

        // GỠ TIM
        else if (data.status === "removed") {

            button.classList.remove("saved");

            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");

        }

        // CHƯA LOGIN
        else if (data.status === "login_required") {

            window.location.href = "/login";

        }

    })

    .catch(error => {
        console.log(error);
    });

});
</script>
@endsection