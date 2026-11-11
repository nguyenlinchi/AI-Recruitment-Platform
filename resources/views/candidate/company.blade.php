@extends('layout.header')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/company.css') }}">
@endsection
@section('content')


<!-- HEADER FULL -->
<div class="company-header-full">

    <!-- Banner -->
    <div class="company-banner">
            <img src="{{ $company->cover_image ?? asset('images/default-logo.png') }}">

        <div class="banner-overlay"></div>
    </div>

    <!-- INFO -->
    <div class="company-info-wrapper">
        <div class="company-info">

            <div class="company-left">
                <div class="company-logo">
                    <img src="{{ $company->avatar ?? asset('images/default-logo.png') }}" alt="logo">
                </div>

                <div class="company-text">
                    <h1>
                        {{ $company->company_name ?? 'CÔNG TY CỔ PHẦN TẬP ĐOÀN TRƯỜNG HẢI' }}
                        <span class="pro-badge">Pro Company</span>
                    </h1>

                    <div class="company-meta">
                        <span><i class="fa-solid fa-globe"></i> {{ $company->website ?? 'https://thacogroup.vn/gioi-thieu' }}</span>
                        <span><i class="fa-solid fa-users"></i> {{ $company->company_size ?? '10000+' }} nhân viên</span>
                        <span><i class="fa-regular fa-heart"></i> {{ $company->followers ?? '3535' }} người theo dõi</span>
                    </div>
                </div>
            </div>

            <button class="follow-btn">
                <i class="fa-regular fa-bookmark"></i> Theo dõi
            </button>

        </div>
    </div>
</div>

<!-- BODY -->

<div class="company-container">

    <div class="company-body">

        <!-- BOX LEFT -->
         <div class="left-col">
            <div class="content-box">

                <div class="section-box">
                    <h3>Giới thiệu công ty</h3>
                    <p> Thành lập : {{ $company->founded_year }}</p>
                    <p class="desc-text" id="descText">
                        {{ $company->description }}
                    </p>
                    <button class="read-more-btn" onclick="toggleText()">
                        Xem thêm
                    </button>
                </div>

            </div>

            <div class="content-box">

                <div class="section-box">
                    <h3>Ứng tuyển</h3>
                    <div class="recruitment-section">
                        <!-- SEARCH -->
                        <form method="GET" action="{{ route('company', $company->employer_id) }}">
                            <div class="search-bar">
                                <!-- Tìm theo tên -->
                                <input 
                                    type="text" 
                                    id="searchInput"
                                    placeholder="Tên công việc, vị trí ứng tuyển..."
                                />
                                <span id="clearBtn">✖</span>

                                <!-- Lọc theo địa điểm -->
                                <select id="locationFilter">
                                    <option value="">Tất cả tỉnh/thành phố</option>

                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_id }}"
                                            {{ request('location_id') == $location->location_id ? 'selected' : '' }}>
                                            {{ $location->location_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn-search">Tìm kiếm</button>

                            </div>
                        </form>

                        <!-- JOB LIST -->
                        <div class="job-wrapper">

                            @foreach($jobs as $job)
                            <div class="job-card-new">

                                <!-- LEFT -->
                                <div class="job-content">

                                    <!-- TITLE -->
                                    <h4 class="job-title">

    <a href="{{ route('jobs.show', $job->job_id) }}"
       class="job-link"
       style="text-decoration:none; color:inherit;">

        {{ $job->job_title }}

    </a>

    <span class="verify">✔</span>

    <span>({{ $job->level->level_name ?? 'Chưa cập nhật' }})</span>

</h4>

                                    <!-- TAGS -->
                                    <div class="job-tags">
                                        <span>{{ $job->address ?? 'Đồng Nai' }}</span>
                                        <span>
                                            @php
                                                $daysLeft = now()->diffInDays(\Carbon\Carbon::parse($job->deadline), false);
                                            @endphp

                                            {{ $daysLeft < 0 ? 'Hết hạn' : 'Còn '.$daysLeft.' ngày' }}
                                        </span>
                                        <span>
                                            @if($job->workplace == 'Online')
                                            <i class="fa-solid fa-laptop"></i>
                                            @elseif($job->workplace == 'Hybrid')
                                                <i class="fa-solid fa-globe"></i>
                                            @else
                                                <i class="fa-solid fa-location-dot"></i>
                                            @endif

                                            {{ $job->workplace }}
                                        </span>
                                    </div>

                                </div>

                                <!-- RIGHT -->
                                <div class="job-right">

                                    <!-- DÒNG 1 -->
                                    <div class="top-row">
                                        <!-- <span class="badge-pro">Ứng tuyển</span> -->
                                         @auth
                                            <a href="{{ route('profile.apply', $job->job_id) }}" class="badge-pro">
                                                Ứng tuyển 
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                            class="badge-pro">
                                                Đăng nhập
                                            </a>
                                        @endauth
                                        <div class="heart">♡</div>
                                    </div>

                                    <!-- DÒNG 2 -->
                                    <div class="salary">
                                        {{ $job->salary->salary_range ?? 'Thỏa thuận' }}
                                    </div>

                                </div>

                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- BOX RIGHT -->
         <div class="right-col">
            <div class="content-box">

                <div class="section-box">
                    <h3>Thông tin liên hệ</h3>

                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>
                            <strong>Địa chỉ công ty</strong><br>
                            {{ $company->location ?? 'Số 10 Mai Chí Thọ, Phường Thủ Thiêm, TP. Thủ Dầu Một' }}
                        </span>
                    </div>
                    <span class="divider"></span>

                    @if($company->location)
                        <iframe 
                            width="100%"
                            height="250"
                            style="border:0;"
                            loading="lazy"
                            allowfullscreen
                            src="https://www.google.com/maps?q={{ urlencode($company->location) }}&output=embed">
                        </iframe>
                    @else
                        <p>Chưa có địa chỉ</p>
                    @endif

                </div>

            </div>
        </div>

    </div>

</div>


<script>
function toggleText() {
    const text = document.getElementById("descText");
    const btn = document.querySelector(".read-more-btn");

    text.classList.toggle("show");

    if (text.classList.contains("show")) {
        btn.innerText = "Thu gọn";
    } else {
        btn.innerText = "Xem thêm";
    }
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("searchInput");
    const clearBtn = document.getElementById("clearBtn");
    const locationFilter = document.getElementById("locationFilter");
    const jobCards = document.querySelectorAll(".job-card-new");

    function filterJobs() {
        const keyword = input.value.toLowerCase();
        const location = locationFilter.value;

        jobCards.forEach(card => {
            const title = card.querySelector(".job-title").innerText.toLowerCase();
            const address = card.querySelector(".job-tags span").innerText;

            let matchKeyword = title.includes(keyword);
            let matchLocation = true;

            if (location) {
                matchLocation = address.includes(location);
            }

            if (matchKeyword && matchLocation) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    // gõ tới đâu lọc tới đó
    input.addEventListener("input", function () {
        filterJobs();
        clearBtn.style.display = input.value ? "block" : "none";
    });

    // lọc theo location
    locationFilter.addEventListener("change", filterJobs);

    // nút X
    clearBtn.addEventListener("click", function () {
        input.value = "";
        clearBtn.style.display = "none";
        filterJobs();
    });

});
</script>
<x-floating-ui />


@include('layout.footer')

@endsection