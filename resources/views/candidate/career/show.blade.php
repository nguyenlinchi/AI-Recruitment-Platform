@extends('layout.header')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/showcareer.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
@endsection

@section('content')

<div class="article-page">

    <div class="article-hero">

        <img src="{{ $post->thumbnail }}" class="hero-image">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <span class="hero-category">
                {{ $post->category->name ?? 'CẨM NANG NGHỀ NGHIỆP' }}
            </span>

            <h1>
                {{ $post->title }}
            </h1>

            <p class="hero-summary">
                {{ $post->summary }}
            </p>

            <div class="hero-meta">

                <span>
                    <i class="fa-regular fa-calendar"></i>
                 {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                </span>
                <span>
                    <i class="fa-regular fa-clock"></i>
                    7 phút đọc
                </span>
                <span>
                    <i class="fa-regular fa-eye"></i>
                    {{ $post->views }} lượt đọc
                </span>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="article-layout">

        {{-- LEFT --}}
        <div class="article-main">

            {{-- SUMMARY BOX --}}
            <div class="summary-box">

                <div class="summary-icon">
                    <i class="fa-regular fa-file-lines"></i>
                </div>

                <div class="summary-content">
                    <h3>Tóm tắt nội dung</h3>
                    <p>
                        {{ $post->summary }}
                    </p>
                </div>
            </div>

            {{-- ARTICLE CONTENT --}}
            <div class="article-content">

                @foreach($post->sections as $index => $sec)

                <div class="content-section">

                    <div class="section-number">
                        {{ $index + 1 }}
                    </div>

                    <div class="section-body">
                        <h2>{{ $sec->title }}</h2>
                        <div class="section-text">
                            {!! $sec->content !!}
                        </div>
                    </div>
                </div>

                @endforeach

            </div>

            {{-- TAGS --}}
            <div class="article-tags">
                <h4>Tags</h4>
                <div class="tags-list">

                    @foreach($post->tags as $tag)
                        <a href="#" class="tag-item">
                            #{{ $tag->name }}
                        </a>
                    @endforeach

                </div>
            </div>

            {{-- SHARE --}}
            <div class="share-box">

                <span>Chia sẻ bài viết</span>
                <div class="share-icons">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook-messenger"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-link"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="article-sidebar">
            {{-- AUTHOR --}}
            <div class="sidebar-card">
                <h3>Tác giả</h3>
                <div class="author-box">
                    <div class="author-avatar">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div>
                        <h4>Good Job Team</h4>
                        <p>
                            Chúng tôi chia sẻ kiến thức và kinh nghiệm giúp bạn định hướng nghề nghiệp.
                        </p>
                    </div>
                </div>
                <button 
                    class="sidebar-btn"
                    onclick="window.location.href='{{ route('career.index') }}'">
                    Xem tất cả bài viết 
                </button>
            </div>

            {{-- RELATED --}}
            <div class="sidebar-card">
                <h3>Bài viết liên quan</h3>
                <div class="related-list">

                    @foreach($related as $item)
                    <a href="{{ route('career.show', $item->guide_id) }}" class="related-item">
                        <img src="{{ $item->thumbnail }}">
                        <div>
                            <h4>
                                {{ $item->title }}
                            </h4>
                            <span>
                                {{ optional($item->created_at)->format('d/m/Y') }}
                            </span>
                        </div>
                    </a>

                    @endforeach
                </div>
                <button 
                    class="sidebar-outline-btn"
                    onclick="window.location.href='{{ route('career.index') }}'">
                    Xem tất cả
                </button>
            </div>

            {{-- MBTI --}}
            <div class="mbti-box">
                <div class="mbti-content">
                    <h3>
                        Khám phá nghề nghiệp phù hợp với bạn
                    </h3>
                    <p>
                        Làm bài test MBTI miễn phí để hiểu rõ tính cách và định hướng nghề nghiệp.
                    </p>
                    <a href="{{ route('mbti.test') }}">
                        Làm trắc nghiệm ngay
                    </a>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png">
            </div>
        </div>
    </div>
</div>

@endsection