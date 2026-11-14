@extends('layout.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Chi tiết Job
            </h2>

            <p class="text-muted">
                Thông tin đầy đủ bài tuyển dụng
            </p>
        </div>

        <a href="/admin/jobs"
           class="btn btn-secondary rounded-pill px-4">

            <i class="fa fa-arrow-left me-2"></i>
            Quay lại

        </a>

    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        {{-- COVER --}}
        <div class="bg-primary text-white p-5">

            <h2 class="fw-bold mb-2">
                {{ $job->job_title }}
            </h2>

            <div class="d-flex flex-wrap gap-3">

                <span>
                    <i class="fa fa-building me-2"></i>
                    {{ $job->employer->company_name ?? '' }}
                </span>

                <span>
                    <i class="fa fa-location-dot me-2"></i>
                    {{ $job->location->location_name ?? '' }}
                </span>

                <span>
                    <i class="fa fa-calendar me-2"></i>
                    Deadline:
                    {{ $job->deadline }}
                </span>

            </div>

        </div>

        <div class="card-body p-5">

            <div class="row">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    {{-- DESCRIPTION --}}
                    <div class="mb-5">

                        <h4 class="fw-bold mb-3">
                            Mô tả công việc
                        </h4>

                        <div class="bg-light p-4 rounded-4">

                            {!! nl2br(e($job->job_description)) !!}

                        </div>

                    </div>

                    {{-- REQUIREMENTS --}}
                    <div class="mb-5">

                        <h4 class="fw-bold mb-3">
                            Yêu cầu ứng viên
                        </h4>

                        <div class="bg-light p-4 rounded-4">

                            {!! nl2br(e($job->candidate_requirements)) !!}

                        </div>

                    </div>

                    {{-- BENEFITS --}}
                    <div class="mb-4">

                        <h4 class="fw-bold mb-3">
                            Quyền lợi
                        </h4>

                        <div class="bg-light p-4 rounded-4">

                            {!! nl2br(e($job->benefits)) !!}

                        </div>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    <div class="card border-0 bg-light rounded-4">

                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-4">
                                Thông tin công việc
                            </h5>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Danh mục
                                </small>

                                <div class="fw-semibold">
                                    {{ $job->category->category_name ?? '' }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Loại công việc
                                </small>

                                <div class="fw-semibold">
                                    {{ $job->jobType->job_type_name ?? '' }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Mức lương
                                </small>

                                <div class="fw-semibold text-success">
                                    {{ $job->salary->salary_range ?? '' }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Level
                                </small>

                                <div class="fw-semibold">
                                    {{ $job->level->level_name ?? '' }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Hình thức làm việc
                                </small>

                                <div class="fw-semibold">
                                    {{ ucfirst($job->workplace) }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Số lượng tuyển
                                </small>

                                <div class="fw-semibold">
                                    {{ $job->quantity }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Giới tính
                                </small>

                                <div class="fw-semibold">
                                    {{ ucfirst($job->gender) }}
                                </div>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted">
                                    Trạng thái
                                </small>

                                <div>

                                    @if($job->status == 1)

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Approved
                                        </span>

                                    @elseif($job->status == 0)

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            Pending
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            Hidden
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection