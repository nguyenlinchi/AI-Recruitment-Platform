@extends('layout.admin')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>
                <h2 class="fw-bold mb-1 text-dark">
                    Career Guides
                </h2>

                <p class="text-muted mb-0">
                    Quản lý bài viết hướng nghiệp chuyên nghiệp
                </p>
            </div>

            <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" onclick="toggleAddForm()">

                <i class="fa fa-plus me-2"></i>
                Thêm bài viết

            </button>

        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show">

                <i class="fa fa-circle-check me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- ADD FORM --}}
        <div id="addForm" class="card border-0 shadow-lg rounded-4 mb-5" style="display:none; overflow:hidden;">

            {{-- TOP --}}
            <div class="bg-primary text-white p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="fw-bold mb-1">
                            Thêm bài viết mới
                        </h4>

                        <p class="mb-0 opacity-75">
                            Tạo bài viết hướng nghiệp cho website
                        </p>

                    </div>

                    <button type="button" class="btn btn-light rounded-circle" onclick="toggleAddForm()">

                        <i class="fa fa-times text-danger"></i>

                    </button>

                </div>

            </div>

            {{-- BODY --}}
            <div class="card-body p-4">

                <form method="POST" action="/admin/careers/store" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        {{-- TITLE --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Tiêu đề
                            </label>

                            <input type="text" name="title" class="form-control rounded-4 py-3"
                                placeholder="Nhập tiêu đề bài viết..." required>

                        </div>

                        {{-- CATEGORY --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Danh mục
                            </label>

                            <select name="category_id" class="form-select rounded-4 py-3">

                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->category_id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- THUMBNAIL --}}
                        <div class="col-md-12 mb-4">

                            <label class="form-label fw-semibold">
                                Thumbnail
                            </label>

                            <div class="position-relative">

                                <img id="preview" src="https://via.placeholder.com/1200x500"
                                    class="img-fluid rounded-4 shadow-sm mb-3 border"
                                    style="width:100%;
                                height:320px;
                                object-fit:cover;">

                            </div>

                            <input type="file" name="thumbnail" class="form-control rounded-4 py-3"
                                onchange="previewImage(event)">

                        </div>

                        {{-- SUMMARY --}}
                        <div class="col-md-12 mb-4">

                            <label class="form-label fw-semibold">
                                Tóm tắt
                            </label>

                            <textarea name="summary" rows="3" class="form-control rounded-4" placeholder="Nhập mô tả ngắn..."></textarea>

                        </div>

                        {{-- CONTENT --}}
                        <div class="col-md-12 mb-4">

                            <label class="form-label fw-semibold">
                                Nội dung
                            </label>

                            <textarea name="content" rows="7" class="form-control rounded-4" placeholder="Nhập nội dung bài viết..."></textarea>

                        </div>

                    </div>

                    <button class="btn btn-primary px-5 py-3 rounded-pill shadow-sm">

                        <i class="fa fa-save me-2"></i>
                        Lưu bài viết

                    </button>

                </form>

            </div>

        </div>

        {{-- LIST --}}
        <div class="row">

            @foreach ($careers as $guide)
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 career-card">

                        {{-- IMAGE --}}
                        <div class="position-relative">

                            <img src="{{ $guide->thumbnail }}" class="w-100"
                                style="height:250px;
                        object-fit:cover;">

                            {{-- CATEGORY --}}
                            <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow">

                                {{ $guide->category->name ?? '' }}

                            </span>

                            {{-- STATUS --}}
                            @if ($guide->status == 1)
                                <span
                                    class="badge bg-success position-absolute bottom-0 start-0 m-3 px-3 py-2 rounded-pill">

                                    Active

                                </span>
                            @else
                                <span class="badge bg-danger position-absolute bottom-0 start-0 m-3 px-3 py-2 rounded-pill">

                                    Hidden

                                </span>
                            @endif

                        </div>

                        {{-- BODY --}}
                        <div class="card-body p-4 d-flex flex-column">

                            <h5 class="fw-bold mb-3 text-dark">

                                {{ $guide->title }}

                            </h5>

                            <p class="text-muted mb-4" style="min-height:70px;">

                                {{ Str::limit($guide->summary, 120) }}

                            </p>

                            {{-- UPDATE --}}
                            <form method="POST" action="/admin/careers/update/{{ $guide->guide_id }}"
                                enctype="multipart/form-data" class="mt-auto">

                                @csrf

                                <div class="mb-3">

                                    <input type="text" name="title" value="{{ $guide->title }}"
                                        class="form-control rounded-4">

                                </div>

                                <div class="mb-3">

                                    <textarea name="summary" rows="3" class="form-control rounded-4">{{ $guide->summary }}</textarea>

                                </div>

                                <div class="mb-3">

                                    <textarea name="content" rows="4" class="form-control rounded-4">{{ $guide->content }}</textarea>

                                </div>

                                <div class="mb-3">

                                    <select name="category_id" class="form-select rounded-4">

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->category_id }}"
                                                {{ $guide->category_id == $cat->category_id ? 'selected' : '' }}>

                                                {{ $cat->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <select name="status" class="form-select rounded-4">

                                        <option value="1" {{ $guide->status == 1 ? 'selected' : '' }}>

                                            Active

                                        </option>

                                        <option value="0" {{ $guide->status == 0 ? 'selected' : '' }}>

                                            Hidden

                                        </option>

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <input type="file" name="thumbnail" class="form-control rounded-4">

                                </div>

                                {{-- BUTTONS --}}
                                <div class="d-grid gap-2">

                                    <button class="btn btn-warning rounded-pill py-2 fw-semibold">

                                        <i class="fa fa-pen me-2"></i>
                                        Cập nhật

                                    </button>

                                    <a href="/admin/careers/delete/{{ $guide->guide_id }}"
                                        class="btn btn-danger rounded-pill py-2 fw-semibold"
                                        onclick="return confirm('Xóa bài viết này?')">

                                        <i class="fa fa-trash me-2"></i>
                                        Xóa

                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

    <style>
        .career-card {
            transition: 0.3s;
        }

        .career-card:hover {
            transform: translateY(-8px);
        }

        .form-control,
        .form-select {
            border: 1px solid #dbe2ea;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #2563eb;
        }
    </style>

    <script>
        function toggleAddForm() {

            const form =
                document.getElementById('addForm');

            if (form.style.display === 'none') {

                form.style.display = 'block';

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            } else {

                form.style.display = 'none';
            }
        }

        function previewImage(event) {

            const reader =
                new FileReader();

            reader.onload = function() {

                document.getElementById('preview').src =
                    reader.result;
            }

            reader.readAsDataURL(
                event.target.files[0]
            );
        }
    </script>
@endsection
