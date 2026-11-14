@extends('layout.header')

@section('title', 'FPT Software Career')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/job.css') }}">
@endsection

@section('content')

<!-- SEARCH -->
    <div class="job-search-section py-5" id="tinh-cach">
        <div class="container search-container">
            <form action="{{ route('jobs.index') }}" method="GET" class="search-box">
                <div class="search-content">
                    <div class="mascot-container">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755142681/job_wrj3pa.png" 
                            alt="Mascot" class="mascot-img">
                    </div>
                    <div class="search-fields">
                        <div class="search-row">
                            <select name="category_id">
                                <option value="">Ngành nghề</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}"
                                        {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                           <select name="location_id">
                                <option value="">Khu vực</option>

                                @foreach($locations as $location)
                                    <option value="{{ $location->location_id }}"
                                        {{ request('location_id') == $location->location_id ? 'selected' : '' }}>
                                        {{ $location->location_name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="title" placeholder="Vị trí, chức danh..." value="{{ request('title') }}">
                            <button type="submit">Tìm kiếm</button>
                            <a href="{{ route('jobs.index') }}" class="btn-reset">Xóa</a>
                        </div>

                        <div class="popular-tags-inside">
                            <span class="fw-bold">Phổ biến:</span>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- JOB PAGE -->
    <div class="job-page py-4">
        <div class="container">

            <!-- HEADER -->
            <div class="row mb-3 align-items-center">

    <div class="col-lg-3">

        <h5 class="filter-title">
            Bộ lọc nâng cao
                <a href="{{ route('jobs.index') }}" class="reset-filter">
                    Đặt lại
                </a>
        </h5>

    </div>

    <div class="col-lg-9 d-flex justify-content-between align-items-center">

        <span>
            Hiển thị
            {{ $jobs->firstItem() ?? 0 }}
            -
            {{ $jobs->lastItem() ?? 0 }}
            của
            {{ $jobs->total() }}
            việc làm
        </span>

        <form method="GET" action="{{ route('jobs.index') }}">

            <!-- giữ filter cũ -->
            <input type="hidden" name="title" value="{{ request('title') }}">

            @if(request('salary'))
                @foreach(request('salary') as $salary)
                    <input type="hidden" name="salary[]" value="{{ $salary }}">
                @endforeach
            @endif

            @if(request('category'))
                @foreach(request('category') as $category)
                    <input type="hidden" name="category[]" value="{{ $category }}">
                @endforeach
            @endif

            <select name="sort"
                    class="job-sort"
                    onchange="this.form.submit()">

                <option value="latest"
                    {{ request('sort') == 'latest' ? 'selected' : '' }}>
                    Mới nhất
                </option>

                <option value="deadline"
                    {{ request('sort') == 'deadline' ? 'selected' : '' }}>
                    Hạn gần nhất
                </option>

            </select>

        </form>

    </div>

</div>

<div class="row">

    <!-- FILTER -->
    <div class="col-lg-3 filter-section">

        <form id="filterForm"
              method="GET"
              action="{{ route('jobs.index') }}">

            <!-- SEARCH -->
            <h6>Tìm kiếm công việc</h6>

            <input
                type="text"
                name="title"
                class="form-control mb-3"
                placeholder="Vị trí, chức danh..."
                value="{{ request('title') }}"
            >

            <!-- CATEGORY -->
            <h6>Ngành nghề</h6>

            @foreach($categories as $category)

                <label>

                    <input
                        type="checkbox"
                        name="category[]"
                        value="{{ $category->category_id }}"
                        {{ in_array($category->category_id, request('category', [])) ? 'checked' : '' }}
                    >

                    {{ $category->category_name }}

                </label>

                <br>

            @endforeach

            <!-- SALARY -->
            <h6 class="mt-3">Mức lương</h6>

            @foreach($salaries as $salary)

                <label>

                    <input
                        type="checkbox"
                        name="salary[]"
                        value="{{ $salary->salary_id }}"
                        {{ in_array($salary->salary_id, request('salary', [])) ? 'checked' : '' }}
                    >

                    {{ $salary->salary_range }}

                </label>

                <br>

            @endforeach

            <!-- LOCATION -->
            <h6 class="mt-3">Khu vực</h6>

            <select name="location_id" class="form-control">

                <option value="">
                    Tất cả khu vực
                </option>

                @foreach($locations as $location)

                    <option
                        value="{{ $location->location_id }}"
                        {{ request('location_id') == $location->location_id ? 'selected' : '' }}
                    >

                        {{ $location->location_name }}

                    </option>

                @endforeach

            </select>

            <!-- BUTTON -->
            <div class="mt-4 d-grid gap-2">

                <button type="submit" class="btn btn-primary">

                    Tìm kiếm

                </button>

                <a href="{{ route('jobs.index') }}"
                   class="btn btn-outline-secondary">

                    Xóa bộ lọc

                </a>

            </div>

        </form>

    </div>

                <!-- JOB LIST -->
            <div class="col-lg-9">
                <div class="row">

                    @forelse($jobs->take(9) as $job)

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="job-card">

                                <!-- TOP -->
                                <div class="job-top">
                                    <div class="job-logo">
                                        <img src="{{ $job->employer->avatar ?? 'https://via.placeholder.com/60' }}">
                                    </div>

                                    <div class="job-info">
                                        <h5>
                                            <a class="job-title" href="{{ route('jobs.show', $job->job_id) }}">
                                                {{ $job->job_title }}
                                            </a>
                                            @include('components.save-job-button')
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

                                <!-- FOOTER -->
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
                                                Ứng tuyển 
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
                        </div>

                    @empty
                        <p>Không có dữ liệu</p>
                    @endforelse

                    </div>
                </div>
                    <!-- 🔥 PHÂN TRANG -->
                <div class="d-flex justify-content-center mt-4" style="margin-left: 100px;" >
                    {{ $jobs->links() }}
                </div>
        </div>
    </div>


<!-- SLOGAN -->
    <div class="slogan-frame">
        <div class="slogan-icon">
            <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1754574797/13_iuyjhm.png">
        </div>
        <div class="slogan-text">
            Chúng tôi không thu bất kì chi phí nào của ứng viên
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

<script>
function submitFilterForm() {
    document.getElementById('filterForm').submit();
}

function resetFilters() {
    // Lấy URL hiện tại và xóa các tham số filter
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);
    
    // Xóa các tham số filter
    params.delete('salary_range');
    params.delete('positions[]');
    params.delete('positions');
    
    // Chuyển hướng đến URL mới
    window.location.href = url.pathname + '?' + params.toString();
}

// JavaScript để xử lý filter
document.addEventListener('DOMContentLoaded', function() {
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

<x-floating-ui />

@include('layout.footer')
@endsection