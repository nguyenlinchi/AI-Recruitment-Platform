@extends('layout.header')

@section('title', 'Cẩm nang nghề nghiệp')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/career.css') }}">
@endsection

@section('content')

<div class="career-container" id="cau-hoi">

    <!-- HERO -->
    <div class="career-hero">
        <h1>Cẩm nang nghề nghiệp</h1>
        <p>Khám phá kiến thức, kỹ năng & định hướng nghề nghiệp</p>
    </div>

    <!-- CATEGORY -->
    <div class="career-categories">
        @foreach($categories as $cate)
            <span>{{ $cate->name }}</span>
        @endforeach
    </div>

    <!-- MAIN -->
    <div class="career-main">

        <div class="career-left">

            <h2 class="section-title">Bài viết nổi bật</h2>

            <div class="featured-wrapper">

                @if($featured->count() > 0)

                    {{-- BIG FEATURE --}}
                    <div class="featured-left">
                        <img src="{{ $featured[0]->thumbnail }}">

                        <div class="featured-left-content">
                            <span class="tag">{{ $featured[0]->category->name ?? '' }}</span>

                            <a href="{{ route('career.show', $featured[0]->guide_id) }}" style="text-decoration:none; color:inherit;">
                                <h3>{{ $featured[0]->title }}</h3>
                            </a>

                            <p>
                                <i class="fa-regular fa-clock"></i>
                                {{ $featured[0]->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- SMALL LIST --}}
                    <div class="featured-right">

                    <!-- FORM SEARCH (QUAN TRỌNG) -->
                    <form method="GET">
                        <div class="search-bar">
                            <input 
                                type="text" 
                                id="searchInput"
                                name="keyword"
                                value="{{ request('keyword') }}"
                                placeholder="Tìm kiếm bài viết..."
                            />
                            <span id="clearBtn">✖</span>
                        </div>
                    </form>


                @foreach($posts as $item)
                <div class="featured-item">
                    <div class="featured-text">
                        <span class="tag">{{ $item->category->name ?? '' }}</span>
                        <a href="{{route('career.show', $item->guide_id)}}" class="title" style="text-decoration:none; color:inherit;" >{{ $item->title }}</a>
                        <p>{{ $item->created_at->format('d/m/Y') }}</p>
                    </div>
                    <img src="{{ $item->thumbnail }}">
                </div>
                @endforeach

                </div>

                @endif

            </div>

        </div>

    </div>
</div>

{{-- ================== LIST ================== --}}

<div class="career-section">

    <h2 class="section-title">Định hướng nghề nghiệp</h2>

    <div class="career-layout">

        <div class="career-list">

            @foreach($guides as $item)
            <div class="career-item">

                <div class="career-content">

                    <span class="category-tag">
                        {{ $item->category->name ?? '' }}
                    </span>

                    <a href="{{ route('career.show', $item->guide_id) }}" class="career-title-link">
                        <h3 class="career-title">
                            {{ $item->title }}
                        </h3>
                    </a>

                    <div class="career-meta">
                        <i class="fa-regular fa-clock"></i>
                        {{ $item->created_at->format('d/m/Y') }}
                    </div>

                    <p class="career-desc">
                        {{ $item->summary }}
                    </p>

                    {{-- TAGS --}}
                    <div class="tags">
                        @foreach($item->tags as $tag)
                            <span>#{{ $tag->name }}</span>
                        @endforeach
                    </div>

                </div>

                <img src="{{ $item->thumbnail }}" class="career-thumb">

            </div>
            @endforeach

        </div>

        <div class="career-sidebar">
            <div class="sidebar-box">
                <h3>60.000+</h3>
                <p>Việc làm đang tuyển dụng</p>
                <button>Tìm việc ngay →</button>
            </div>

            <div class="sidebar-banner">
                <img src="https://via.placeholder.com/300x200">
            </div>
        </div>

    </div>
</div>



<div class="career-container">

<div class="tips-section">
    
    <!-- HEADER -->
    <div class="tips-header">
        <h2>Bí kíp tìm việc</h2>
        <a href="#">Xem tất cả <span>›</span></a>
    </div>

    <!-- GRID -->
    <div class="tips-grid">

        @foreach($tips as $item)
        <div class="tips-card">

            <div class="tips-image">
                <img src="{{ $item->thumbnail }}">
            </div>

            <div class="tips-content">

                <span class="tips-tag">
                    {{ $item->category->name ?? 'BÍ KÍP TÌM VIỆC' }}
                </span>

                <a href="{{ route('career.show', $item->guide_id) }}" class="career-title-link">
                        <h3 class="career-title">
                            {{ $item->title }}
                        </h3>
                </a>

                <p class="meta">
                    <i class="fa-regular fa-clock"></i>
                        {{ $item->created_at->format('d/m/Y') }}
                </p>

                <p class="desc">
                    {{ $item->summary }}
                </p>

            </div>

        </div>
        @endforeach

    </div>

</div>
</div>

<div class="career-container">
    <div class="market-news-wrapper">
        
        <div class="market-column">

            <div class="column-header">
                <h2 class="column-title">Thị trường và xu hướng tuyển dụng</h2>
            </div>

            <div class="news-list">

                @foreach($trends as $item)
                <div class="news-item">

                    <div class="news-info">

                        <span class="news-tag green">
                            {{ $item->category->name }}
                        </span>

                        <a href="{{ route('career.show', $item->guide_id) }}" class="news-headline career-title-link">
                        <h3 class="career-title">
                            {{ $item->title }}
                        </h3>
                        </a>

                        <p class="news-meta">
                            <i class="fa-regular fa-clock"></i>
                            {{ $item->created_at->format('d/m/Y') }}
                        </p>

                        <p class="news-excerpt">
                            {{ $item->summary }}
                        </p>
                    </div>
                    <img src="{{ $item->thumbnail }}" class="news-thumb">
                </div>
                @endforeach

            </div>
        </div>
                <div class="market-column">
            <div class="column-header">
                <h2 class="column-title">Kỹ năng nghề nghiệp</h2>
            </div>

            <div class="news-list">

                @foreach($skills as $item)
                <div class="news-item">
                    <div class="news-info">
                        <span class="news-tag orange">
                            {{ $item->category->name }}
                        </span>
                        <a href="{{ route('career.show', $item->guide_id) }}" class="news-headline career-title-link">
                        <h3 class="career-title">
                            {{ $item->title }}
                        </h3>
                        </a>
                        <p class="news-meta">
                          {{ $item->created_at->format('d/m/Y') }}
                        </p>

                        <p class="news-excerpt">
                            {{ $item->summary }}
                        </p>

                    </div>

                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>

<div class="career-container">
    <div class="mbti-banner">
        <div class="mbti-content">
            <div class="mbti-logo">
                <span class="mbti-brand">MBTI</span> <small>by</small>
            </div>
            <h2 class="mbti-title">TRẮC NGHIỆM<br>TÍNH CÁCH MBTI</h2>
            <a href="{{ route('mbti.home') }}" class="mbti-btn">Làm trắc nghiệm ngay</a>
        </div>
        
        <div class="mbti-cards-wrapper">
            <div class="mbti-card card-istj"></div>
            <div class="mbti-card card-isfp"></div>
            <div class="mbti-card card-isfj"></div>
            <div class="mbti-card card-enfj"></div>
            <div class="mbti-card card-esfp"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("searchInput");
    const clearBtn = document.getElementById("clearBtn");
    const items = document.querySelectorAll(".featured-item");

    function removeVietnameseTones(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    function filterFeatured() {

        const keyword = removeVietnameseTones(input.value);

        items.forEach(item => {

            const titleEl = item.querySelector(".title");
            if (!titleEl) return;

            const title = removeVietnameseTones(titleEl.innerText);

            if (title.includes(keyword)) {
                item.style.display = "flex";
            } else {
                item.style.display = "none";
            }

        });
    }

    input.addEventListener("input", function () {
        filterFeatured();
        clearBtn.style.display = input.value ? "inline" : "none";
    });

    clearBtn.addEventListener("click", function () {
        input.value = "";
        clearBtn.style.display = "none";

        items.forEach(item => {
            item.style.display = "flex";
        });
    });

});
</script>

<x-floating-ui />

@include('layout.footer')

@endsection