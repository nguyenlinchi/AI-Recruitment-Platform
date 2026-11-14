@extends('layout.header')

@section('content')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/showjobs.css') }}">
@endsection
<div class="container mx-auto p-4">

    <div class="banner-img">
        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755158462/bannerchitiet_mo4rlb.png" alt="Banner" class="w-full">
    </div>

    <div class="title-apply-container">

    <h1 class="job-title">
        {{ $job->job_title }}
    </h1>

        <div class="job-action-group">

            @include('components.save-job-button')

            @auth
                <a href="{{ route('profile.apply', $job->job_id) }}"
                class="apply-btn">
                    Ứng tuyển
                </a>
            @else
                <a href="{{ route('login') }}"
                class="apply-btn">
                    Nộp hồ sơ
                </a>
            @endauth
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="job-detail-info">

    <div class="info-item">
        <i class="fa-solid fa-clock"></i>

        <span>
            {{ $job->deadline
                ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y')
                : ''
            }}
        </span>
    </div>

    <div class="info-item">

        @if($job->workplace == 'Online')

            <i class="fa-solid fa-laptop"></i>

        @elseif($job->workplace == 'Hybrid')

            <i class="fa-solid fa-globe"></i>

        @else

            <i class="fa-solid fa-location-dot"></i>

        @endif

        <span>{{ $job->workplace }}</span>

    </div>

</div>


    <div class="card-row">
        <!-- Card bên trái -->
        <div class="card-left">
            <h2 class="font-semibold mb-2">Thông tin công việc</h2>

            <div class="job-info-grid">
                <p><strong>Đơn vị:</strong> {{ $job->employer->company_name ?? 'Chưa cập nhật' }}</p>
                <p><strong>Số lượng:</strong> {{ $job->quantity ?? 1 }}</p>

                <p><strong>Mức lương:</strong> {{ $job->salary->salary_range ?? 'Thỏa thuận' }}</p>
                <p><strong>Loại hình:</strong> {{ $job->jobType->job_type_name ?? 'Toàn thời gian' }}</p>

                <p><strong>Giới tính:</strong> {{ $job->gender_requirement ?? 'Không yêu cầu' }}</p>
            </div>
        </div>

        <div class="card-right">
            <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755165269/chitiet_t86jag.png" alt="Icon">
            <div class="location-content">
                <h3 class="font-semibold">Nơi làm việc</h3>
                
                <p><i class="fa-solid fa-location-dot"></i>   {{$job->address ?? 'Đà Nẵng' }}</p>
            </div>
        </div>
    </div>

    <div class="card-row">
       <!-- LEFT -->
        <div class="left-content">

            <div class="section-card">
                <h2 class="section-title blue">Mô tả công việc</h2>
                <div class="section-content">
                    {!! nl2br(e($job->job_description)) !!}
                </div>
            </div>

            <div class="section-card">
                <h2 class="section-title orange">Yêu cầu</h2>
                <div class="section-content">
                    {!! nl2br(e($job->candidate_requirements)) !!}
                </div>
            </div>

            <div class="section-card">
                <h2 class="section-title green">Quyền lợi</h2>
                <div class="section-content">
                    {!! nl2br(e($job->benefits)) !!}
                </div>
            </div>

        </div>

        <div class="card-right1 location">
            <div>
                <h3 class="font-semibold" style="color: #173c74; margin-bottom: 20px;">Giới thiệu về công ty</h3>
                <p>{{  $job->employer->description ?? 'Chưa có mô tả' }}</p>
            </div>
        </div>
    </div>

    <div class="contact-map-box">

    <!-- LEFT: CONTACT -->
        <div class="contact-info">
            <h2>Thông tin liên hệ</h2>
            <p><strong>Người phụ trách:</strong> {{ $job->employer->contact_name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $job->employer->hr_email ?? 'N/A' }}</p>
            <p><strong>SĐT:</strong> {{ $job->employer->phone ?? 'N/A' }}</p>
        </div>

        <!-- RIGHT: MAP -->
        <div class="map-box">

            @if($job->address)
                <iframe 
                    src="https://www.google.com/maps?q={{ urlencode($job->address) }}&output=embed">
                </iframe>
            @else
                <p>Chưa có địa chỉ</p>
            @endif
        </div>
    </div>
    

   <div class="related-jobs">
    <h3>Việc làm liên quan</h3>

    <div class="related-grid">
        @foreach($relatedJobs as $item)
            <div class="related-card">

                <!-- TITLE -->
                <h4 class="related-job-title">
                    {{ $item->job_title }}
                </h4>

                <!-- INFO -->
                <div class="job-meta">
                    <span>💼 {{ $item->jobType->job_type_name ?? 'Fulltime' }}</span>
                    <span>📍 {{ $item->location->location_name ?? $item->workplace }}</span>
                </div>

                <!-- DEADLINE -->
                <div class="job-deadline">
                    ⏰ Hạn: {{ \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') }}
                </div>

                <!-- LINE -->
                <div class="divider"></div>

                <!-- FOOTER -->
                <div class="job-footer">
                    <div class="salary">
                        {{ $item->salary->salary_range ?? 'Thỏa thuận' }}
                    </div>

                    <a href="{{ route('jobs.show', $item->job_id) }}" class="btn-apply">
                        Ứng tuyển
                    </a>
                </div>

            </div>
        @endforeach
    </div>
    <div class="view-more-wrap">
        <a href="{{ route('jobs.index') }}" class="btn-view-more">
            Xem thêm việc làm
        </a>
    </div>
 </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star-rating .star");
        const input = document.getElementById("satisfaction");

        stars.forEach(star => {
            star.addEventListener("click", function () {
                let value = this.getAttribute("data-value");
                input.value = value;

                
            // reset hiển thị
            stars.forEach(s => s.classList.remove("selected"));

            // thêm màu vàng cho sao được chọn
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("selected");
            }
            });
        });
    });
</script>

<button id="scrollTopBtn">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" viewBox="0 0 24 24">
    <path d="M12 8l6 6H6z"/>
  </svg>
</button>


<style>
  #scrollTopBtn {
    position: fixed;
    bottom: 40px; 
    right: 28px;
    background: #f88705ff;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 9997;
    display: none; /* ẩn mặc định */
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }
  #scrollTopBtn:hover {
    background: #f1d42eff;
    transform: scale(1.05);
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.getElementById("scrollTopBtn");

    // Hiện nút khi cuộn xuống 200px
    window.addEventListener("scroll", () => {
      if (window.scrollY > 200) {
        scrollBtn.style.display = "flex";
      } else {
        scrollBtn.style.display = "none";
      }
    });

    // Sự kiện click -> cuộn lên đầu
    scrollBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });
</script>

@include('layout.footer')
@endsection
