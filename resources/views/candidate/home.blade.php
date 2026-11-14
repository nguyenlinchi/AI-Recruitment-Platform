@extends('layout.header')

@section('title', 'Search Job')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="banner">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="container main-container">
            <div class="banner-content-wrapper">
                <div class="banner-text">
                    <div class="badge-wrapper">
                        <span class="badge-custom">
                            <i class="fa-solid fa-bolt"></i> Gia nhập mạng lưới IT
                        </span>
                    </div>
                    <h1>Tìm việc mơ ước <br> <span>Nâng tầm sự nghiệp</span></h1>
                    <p>Khám phá hàng nghìn cơ hội việc làm hấp dẫn từ các công ty hàng đầu với hệ thống hỗ trợ AI thông minh.</p>

                    <form action="{{ route('home') }}" method="GET" class="search-card">
                        <div class="search-inputs">
                            <div class="input-field">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" name="location" placeholder="Địa điểm..." value="{{ request('location') }}">
                            </div>
                            <div class="input-field">
                                <i class="fa-solid fa-briefcase"></i>
                                <input type="text" name="title" placeholder="Vị trí, chức danh..." value="{{ request('title') }}">
                            </div>
                        </div>
                        <div class="search-actions">
                            <button type="submit" class="btn-search">Tìm kiếm</button>
                            <a href="{{ route('home') }}" class="btn-clear" title="Xóa bộ lọc">
                                <i class="fa-solid fa-rotate-right"></i>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="banner-visual">
                    <div class="visual-container">
                        <div class="video-frame">
                            <video autoplay muted loop playsinline class="inner-video">
                                <source src="https://res.cloudinary.com/dumvx2lsj/video/upload/v1755831998/video1_zvxgkw.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="floating-card card-1">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>10k+ Tuyển dụng</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fa-solid fa-users"></i>
                            <span>500+ Công ty</span>
                        </div>
                        <div class="dots-decor"></div>
                    </div>
                </div>
            </div>

            <div class="features-bar">
                <div class="f-item">
                    <div class="f-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="f-text">
                        <strong>Hàng nghìn việc làm</strong>
                        <span>Cập nhật mỗi ngày</span>
                    </div>
                </div>
                <div class="f-item">
                    <div class="f-icon"><i class="fa-solid fa-building"></i></div>
                    <div class="f-text">
                        <strong>Top công ty uy tín</strong>
                        <span>Đối tác hàng đầu</span>
                    </div>
                </div>
                <div class="f-item">
                    <div class="f-icon"><i class="fa-solid fa-file-invoice"></i></div>
                    <div class="f-text">
                        <strong>Tạo CV dễ dàng</strong>
                        <span>Nổi bật hồ sơ</span>
                    </div>
                </div>
                <div class="f-item">
                    <div class="f-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="f-text">
                        <strong>Phát triển sự nghiệp</strong>
                        <span>Tư vấn lộ trình</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-section" id="cong-viec">
        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755698189/fpt-right-element1_bn4dxg.png" 
            alt="Left Decor" class="decor-left d-none d-lg-block">
        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755698197/2_os2iu6.png" 
            alt="Right Decor" class="decor-right d-none d-lg-block">

        <h1 class="job-title">Cơ hội nghề nghiệp</h1>

        <div class="job-list">

        @forelse($jobs as $job)

        <div class="job-card">
            <div class="job-top">

                <!-- LOGO -->
                <div class="job-logo">
                    <img src="{{ $job->employer->avatar ?? 'https://via.placeholder.com/60' }}">
                </div>

                <!-- CONTENT -->
                <div class="job-info">
                    <h5>
                        <a href="{{ route('jobs.show', $job->job_id) }}" style="text-decoration:none; color:inherit;">{{ $job->job_title }}</a>
                       @include('components.save-job-button', [
                            'job' => $job,
                            'savedJobIds' => $savedJobIds
                        ])

                    </h5>

                    <a href="{{ route('company', $job->employer_id) }}" class="company-link" style="text-decoration:none; color:inherit;">
                    {{ $job->employer->company_name ?? 'Chưa có công ty' }}
                    </a><br>

                    <span class="job-deadline">
                        Thời hạn: 
                        {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : '' }}
                    </span>
                </div>
            </div>

            <span class="divider"></span>

            <div class="job-footer">
                <div class="job-meta">
                    <small>
                        {{ $job->jobType->job_type_name ?? 'Toàn thời gian' }} | 
                        {{ $job->location->location_name ?? 'Đà Nẵng' }}
                    </small>
                </div>

                <div class="job-bottom">
                    <span class="job-salary">
                        {{ $job->salary->salary_range ?? 'Thỏa thuận' }}
                    </span>

            @auth
                <a href="{{ route('profile.apply', $job->job_id) }}" class="apply-btn">
                    Ứng tuyển ngay
                </a>
            @else
                <a href="{{ route('login') }}"
                class="apply-btn">
                    Đăng nhập
                </a>
            @endauth
                </div>
            </div>
        </div>

        @empty
            <p>Không có dữ liệu</p>
        @endforelse

        </div>

        <div class="view-all-wrapper">
        <a href="{{ route('jobs.index') }}" class="view-all-btn">
            Xem tất cả
        </a>
        </div>
    </div>


    <div class="company-section">

        <!-- HEADER -->
        <div class="company-header">
            <h2>Công ty lớn tiêu biểu</h2>
            <p>Hàng trăm thương hiệu lớn tiêu biểu đang tuyển dụng</p>
        </div>

        <div class="company-container">

            {{-- LEFT BIG CARD --}}
            @if($topEmployers->count() > 0)
            @php $big = $topEmployers->first(); @endphp

            <div class="company-big">
                <img src="{{ $big->avatar ?? 'images/default.png' }}" class="logo">

                <a href="{{ route('company', $big->employer_id) }}" style="text-decoration:none; color:inherit;">
                    <h3>{{ $big->company_name }}</h3>
                </a> 
                <p>{{ $big->company_type ?? 'Chưa cập nhật' }}</p>

                <span class="job-count">{{ $big->jobs_count }} việc làm</span>

                <button class="pro-btn">Pro Company</button>
                <button class="follow-btn">+ Theo dõi</button>
            </div>
            @endif


            {{-- RIGHT GRID: 3 hàng × 3 --}}
            <div class="company-grid">

                @foreach($topEmployers->skip(1)->take(9)->chunk(3) as $row)
                <div class="company-row">

                    @foreach($row as $employer)
                    <div class="company-card">
                        <img src="{{ $employer->avatar ?? 'images/default.png' }}">

                        <div>
                            <a  href="{{ route('company', $employer->employer_id) }}" style="text-decoration:none; color:inherit;">
                                <h4>{{ $employer->company_name }}</h4>
                            </a>                            
                            <p>{{ $employer->company_type ?? 'Chưa cập nhật' }}</p>
                            <span>{{ $employer->jobs_count }} việc làm</span>
                        </div>
                    </div>
                    @endforeach

                </div>
                @endforeach

            </div>

        </div>


        {{-- PHẦN DƯỚI - KHÔNG TRÙNG --}}
        <div class="company-grid">

            @foreach($otherEmployers as $employer)
            <div class="company-card">
                <img src="{{ $employer->avatar ?? 'images/default.png' }}">

                <div>
                    <a  href="{{ route('company', $employer->employer_id) }}"  style="text-decoration:none; color:inherit;">
                        <h4>{{ $employer->company_name }}</h4>
                    </a> 
                    <p>{{ $employer->company_type ?? 'Chưa cập nhật' }}</p>
                    <span>{{ $employer->jobs_count }} việc làm</span>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    <div class="job-dashboard">
        <div class="header-section">
            <h2>
                <i class="fa-solid fa-chart-line"></i> Thị trường việc làm hôm nay
                <span>{{ now()->format('d/m/Y') }}</span>
            </h2>
        </div>

        <div class="dashboard-container">
            <div class="left-panel">
                <div class="panel-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" class="robot-icon" alt="robot">
                    <h3>Công ty tiêu biểu</h3>
                    
                    <div class="company-list">
                        @foreach($featuredCompanies as $index => $company)
                        <a href="{{ route('company', $company->employer_id) }}" 
                        class="company-item" 
                        style="--i: {{ $index }};">
                            <div class="company-content">
                                <div class="company-top">
                                    <div class="logo-wrapper">
                                        <img src="{{ $company->avatar }}" class="company-logo" alt="{{ $company->company_name }}">
                                    </div>
                                    <span class="name" title="{{ $company->company_name }}">{{ $company->company_name }}</span>
                                </div>
                                <div class="company-bottom">
                                    <p class="loc">
                                        <i class="fa-solid fa-location-dot"></i> {{ $company->location }}
                                    </p>
                                </div>
                            </div>
                            <div class="hover-indicator"></div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="right-panel">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fa-solid fa-briefcase"></i></div>
                        <div class="stat-data">
                            <h1>{{ $newJobsToday }}</h1>
                            <p>Mới hôm nay</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="stat-data">
                            <h1>{{ $totalJobs }}</h1>
                            <p>Đang tuyển</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange"><i class="fa-solid fa-building"></i></div>
                        <div class="stat-data">
                            <h1>{{ $totalCompanies }}</h1>
                            <p>Đối tác</p>
                        </div>
                    </div>
                </div>

                <div class="charts-grid">
                    <div class="chart-container">
                        <h4><i class="fa-solid fa-arrow-trend-up"></i> Tăng trưởng cơ hội</h4>
                        <canvas id="jobGrowthChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h4><i class="fa-solid fa-layer-group"></i> Nhu cầu theo ngành</h4>
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="job-category">
    <div class="header">
        <h2>Ngành nghề nổi bật</h2>

        <div class="nav-btns">
            <button id="prev">&#8592;</button>
            <button id="next">&#8594;</button>
        </div>
    </div>

    <div class="category-wrapper">
        <div class="category-grid" id="slider">

            @foreach($categories as $category)
            <div class="card">
                <img src="{{ $category->image ?? 'images/default-category.png' }}">

                <div class="info">
                    <h3>{{ $category->category_name }}</h3>
                    <p>+{{ $category->jobs_count }} Việc Làm</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    </section>

    <section class="process-section">
        <div class="process-header">
            <span class="badge">Quy trình thông minh</span>
            <h2>Cách thức hoạt động</h2>
            <p>Quy trình với 3 bước đơn giản, minh bạch và hoàn toàn không mất phí cho ứng viên.</p>
        </div>

        <div class="process-steps">
            <div class="process-step" style="--order: 1">
                <div class="step-card">
                    <div class="circle">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span class="step-number">01</span>
                    </div>
                    <h3>Tải lên CV</h3>
                    <p>Hệ thống AI sẽ tự động phân tích sâu các kỹ năng và kinh nghiệm. Mọi dữ liệu được chuẩn hóa thông minh để làm nổi bật hồ sơ của bạn.</p>
                </div>
            </div>

            <div class="connector-wrapper">
                <svg class="step-connector" viewBox="0 0 200 100">
                    <path d="M0,50 Q100,0 200,50" class="path-bg" />
                    <path d="M0,50 Q100,0 200,50" class="path-active" />
                </svg>
            </div>

            <div class="process-step" style="--order: 2">
                <div class="step-card">
                    <div class="circle">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span class="step-number">02</span>
                    </div>
                    <h3>Lọc & Gợi ý</h3>
                    <p>Dựa trên Matching Score, AI đề xuất những vị trí phù hợp nhất. Bạn không còn phải tốn hàng giờ để tìm kiếm thủ công.</p>
                </div>
            </div>

            <div class="connector-wrapper">
                <svg class="step-connector" viewBox="0 0 200 100">
                    <path d="M0,50 Q100,100 200,50" class="path-bg" />
                    <path d="M0,50 Q100,100 200,50" class="path-active" />
                </svg>
            </div>

            <div class="process-step" style="--order: 3">
                <div class="step-card">
                    <div class="circle">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span class="step-number">03</span>
                    </div>
                    <h3>Ứng tuyển</h3>
                    <p>Với một cú click, hồ sơ sẽ được gửi trực tiếp. Theo dõi trạng thái phản hồi thời gian thực, giúp bạn nắm bắt cơ hội ngay lập tức.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
    <div class="features-header">
        <h2 class="features-title">Cùng chúng tôi đồng hành phát triển</h2>
        <div class="title-underline"></div>
    </div>
    
    <div class="features-list">
        <div class="feature-card feature-blue" style="--i: 1">
            <div class="card-overlay"></div>
            <div class="feature-content">
                <div class="icon-box"><i class="fa-solid fa-id-card"></i></div>
                <h3>Thương hiệu<br><span class="highlight">Cá nhân</span></h3>
                <p>Đánh thức tiềm năng trong CV của bạn với công nghệ lọc AI, biến mỗi dòng kinh nghiệm thành thỏi nam châm thu hút nhà tuyển dụng.</p>
                <div class="card-footer">Khám phá ngay <i class="fa-solid fa-arrow-right"></i></div>
            </div>
        </div>

        <div class="feature-card feature-orange" style="--i: 2">
            <div class="card-overlay"></div>
            <div class="feature-content">
                <div class="icon-box"><i class="fa-solid fa-microchip"></i></div>
                <h3>Công nghệ<br><span class="highlight1">Tiên phong</span></h3>
                <p>Đắm mình trong hệ sinh thái AI thông minh để trải nghiệm quy trình tuyển dụng tương lai và làm chủ các giải pháp dẫn đầu.</p>
                <div class="card-footer">Trải nghiệm AI <i class="fa-solid fa-arrow-right"></i></div>
            </div>
        </div>

        <div class="feature-card feature-green" style="--i: 3">
            <div class="card-overlay"></div>
            <div class="feature-content">
                <div class="icon-box"><i class="fa-solid fa-rocket"></i></div>
                <h3>Nâng tầm<br><span class="highlight2">Sự nghiệp</span></h3>
                <p>Mở khóa lộ trình thăng tiến bứt phá với các cơ hội đào tạo chuyên sâu và nền tảng phát triển không giới hạn.</p>
                <div class="card-footer">Bắt đầu hành trình <i class="fa-solid fa-arrow-right"></i></div>
            </div>
        </div>
    </div>
</section>

    <div class="hero-section" id="gioi-thieu">
        <div class="hero-image">
            <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1754574012/cover_fwpo3i.png" alt="FPT Telecom Hero" />

        <img class="corner-image" src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1754574797/13_iuyjhm.png" alt="Overlay Image">

        </div>
        <div class="hero-content">
            <h2>
                <span class="good-job">Good Job</span><br>
                <span class="highlight">Hành trình kết nối & Kiến tạo</span> tương lai
            </h2>
            <p>
            Tại <span class="good-job">Good Job</span>, mỗi cơ hội nghề nghiệp là một hành trình để bạn bứt phá giới hạn và kết nối cùng những 
            đồng đội chung đam mê. Chúng tôi mang đến một hệ sinh thái công nghệ tiên phong, nơi ứng viên dễ dàng
            tìm thấy công việc mơ ước và nhà tuyển dụng tối ưu hóa quy trình lọc CV thông minh. Gia nhập Good job,
            bạn không chỉ xây dựng sự nghiệp mà còn cùng chúng tôi kiến tạo một tương lai số bền vững và đột phá.
            </p>
            <div class="hero-buttons">
                    <a href="#" class="">  Về chúng tôi</a>
                    <a href="#" class="btn-secondary">Life at FTEL</a>
            </div>
        </div>
    </div>
    <section class="blog-section" id="su-kien">
        <div class="blog-header">
            <div>
            <h2>Blog & Tài nguyên</h2>
            <p>Góc chia sẻ từ chuyên gia để bứt phá sự nghiệp của bạn</p>
            </div>
            <a href="{{ route('career.index') }}" class="view-all" style="text-decoration:none; color:inherit;">Xem tất cả →</a>
        </div>

        <div class="blog-grid">

            @foreach($guides as $item)

            <div class="blog-card">

                <div class="blog-image">
                    <img src="{{ $item->thumbnail }}" alt="">

                    <span class="tag">
                        #{{ $item->category->name ?? 'Career' }}
                    </span>
                </div>

                <div class="blog-content">

                    <h3>
                        {{ $item->title }}
                    </h3>

                    <p>
                        {{ $item->summary }}
                    </p>

                    {{-- TAGS --}}
                    <div class="tags">

                        @foreach($item->tags as $tag)
                            <span>#{{ $tag->name }}</span>
                        @endforeach

                    </div>

                    <a href="{{ route('career.show', $item->guide_id) }}">
                        Đọc tiếp →
                    </a>

                </div>

            </div>

            @endforeach

        </div>
    </section>

    <section class="press">
    <h2>Báo chí nói về Good Job</h2>

    <div class="press-container" id="pressContainer">
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/0/0f/Vietnambiz_logo.png"></div>
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Cafebiz_logo.png"></div>
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Dautu_logo.png"></div>
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/Genk_logo.png"></div>
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Kenh14_logo.png"></div>
        <div class="press-item"><img src="https://upload.wikimedia.org/wikipedia/commons/2/2c/Theleader_logo.png"></div>
        
    </div>
    </section>


<meta name="csrf-token" content="{{ csrf_token() }}">


<script>
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("slider");
    const next = document.getElementById("next");
    const prev = document.getElementById("prev");

    const cards = Array.from(slider.querySelectorAll(".card"));
    const itemsPerPage = 8;

    slider.innerHTML = ""; // clear

    // 👉 chia page tự động
    for (let i = 0; i < cards.length; i += itemsPerPage) {
        const page = document.createElement("div");
        page.classList.add("page");

        const group = cards.slice(i, i + itemsPerPage);
        group.forEach(card => page.appendChild(card));

        slider.appendChild(page);
    }

    let index = 0;
    const total = document.querySelectorAll(".page").length;

    next.onclick = () => {
        if (index < total - 1) {
            index++;
            slider.style.transform = `translateX(-${index * 100}%)`;
        }
    };

    prev.onclick = () => {
        if (index > 0) {
            index--;
            slider.style.transform = `translateX(-${index * 100}%)`;
        }
    };
});
</script>
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
  
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll(".press-item");
    const container = document.getElementById("pressContainer");

    const containerWidth = container.offsetWidth;
    const containerHeight = container.offsetHeight;

    items.forEach(item => {
       
        const size = Math.floor(Math.random() * 60) + 80; 
        item.style.width = size + "px";
        item.style.height = size + "px";

        const x = Math.random() * (containerWidth - size);
        const y = Math.random() * (containerHeight - size);

        item.style.left = x + "px";
        item.style.top = y + "px";

        animate(item);
    });

    function animate(el) {
        let x = parseFloat(el.style.left);
        let y = parseFloat(el.style.top);

        let dx = (Math.random() - 0.5) * 2.5;
        let dy = (Math.random() - 0.5) * 2.5;

        function move() {
            x += dx;
            y += dy;

            if (x <= 0 || x >= container.offsetWidth - el.offsetWidth) dx *= -1;
            if (y <= 0 || y >= container.offsetHeight - el.offsetHeight) dy *= -1;

            el.style.left = x + "px";
            el.style.top = y + "px";

            requestAnimationFrame(move);
        }

        move();
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>



const growthCtx = document.getElementById('jobGrowthChart');

new Chart(growthCtx, {
    type: 'line',
    data: {
        labels: @json($jobGrowthLabels),
        datasets: [{
            label: 'Số lượng việc làm',
            data: @json($jobGrowthData),
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.15)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



const categoryCtx = document.getElementById('categoryChart');

new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: @json($categoryLabels),
        datasets: [{
            data: @json($categoryData),
            backgroundColor: [
                '#3b82f6',
                '#10b981',
                '#f59e0b',
                '#ef4444'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

</script>

<x-floating-ui />

@include('layout.footer')

@endsection