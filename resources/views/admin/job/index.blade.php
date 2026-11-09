@extends('layout.admin')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    Quản lý Job Postings
                </h2>

                <p class="text-muted mb-0">
                    Duyệt và quản lý tin tuyển dụng
                </p>
            </div>

            <div class="bg-white shadow-sm rounded-pill px-4 py-2">

                <span class="fw-semibold text-primary">
                    Tổng Jobs:
                </span>

                <span class="fw-bold">
                    {{ count($jobs) }}
                </span>

            </div>

        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show">

                <i class="fa fa-circle-check me-2"></i>

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- TABLE --}}
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">

                            <tr>

                                <th class="ps-4 py-3">
                                    ID
                                </th>

                                <th class="py-3">
                                    Công việc
                                </th>

                                <th class="py-3">
                                    Công ty
                                </th>

                                <th class="py-3">
                                    Khu vực
                                </th>

                                <th class="py-3">
                                    Deadline
                                </th>

                                <th class="py-3">
                                    Trạng thái
                                </th>

                                <th class="text-center py-3" style="width:280px">
                                    Hành động
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($jobs as $job)
                                <tr class="border-top">

                                    {{-- ID --}}
                                    <td class="ps-4 fw-bold text-primary">

                                        #{{ $job->job_id }}

                                    </td>

                                    {{-- JOB --}}
                                    <td>

                                        <div class="fw-bold fs-6">

                                            {{ $job->job_title }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $job->category->category_name ?? 'No category' }}

                                        </small>

                                    </td>

                                    {{-- COMPANY --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $job->employer->company_name ?? 'Unknown' }}

                                        </div>

                                    </td>

                                    {{-- LOCATION --}}
                                    <td>

                                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">

                                            <i class="fa fa-location-dot me-1 text-danger"></i>

                                            {{ $job->location->location_name ?? '' }}

                                        </span>

                                    </td>

                                    {{-- DEADLINE --}}
                                    <td>

                                        <span class="text-danger fw-semibold">

                                            {{ $job->deadline }}

                                        </span>

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if ($job->status == 1)
                                            <span class="badge bg-success px-3 py-2 rounded-pill">

                                                <i class="fa fa-circle-check me-1"></i>
                                                Approved

                                            </span>
                                        @elseif($job->status == 0)
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                                                <i class="fa fa-clock me-1"></i>
                                                Pending

                                            </span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2 rounded-pill">

                                                <i class="fa fa-eye-slash me-1"></i>
                                                Hidden

                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                                            {{-- DETAIL BUTTON --}}
                                            <a href="/admin/jobs/show/{{ $job->job_id }}"
                                                class="btn btn-info btn-sm rounded-pill px-3 text-white">

                                                <i class="fa fa-eye me-1"></i>
                                                Chi tiết

                                            </a>

                                            {{-- APPROVE --}}
                                            @if ($job->status == 0 || $job->status == 2)
                                                <form method="POST" action="/admin/jobs/update-status/{{ $job->job_id }}">

                                                    @csrf

                                                    <input type="hidden" name="status" value="1">

                                                    <button class="btn btn-success btn-sm rounded-pill px-3">

                                                        <i class="fa fa-check me-1"></i>

                                                        Duyệt

                                                    </button>

                                                </form>
                                            @endif

                                            {{-- HIDE --}}
                                            @if ($job->status == 1)
                                                <form method="POST"
                                                    action="/admin/jobs/update-status/{{ $job->job_id }}">

                                                    @csrf

                                                    <input type="hidden" name="status" value="2">

                                                    <button class="btn btn-warning btn-sm rounded-pill px-3 text-white">

                                                        <i class="fa fa-eye-slash me-1"></i>

                                                        Ẩn

                                                    </button>

                                                </form>
                                            @endif

                                            {{-- DELETE --}}
                                            <a href="/admin/jobs/delete/{{ $job->job_id }}"
                                                class="btn btn-danger btn-sm rounded-pill px-3"
                                                onclick="return confirm('Xóa job này?')">

                                                <i class="fa fa-trash"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                                {{-- MODAL DETAIL --}}
                                <div class="modal fade" id="jobModal{{ $job->job_id }}" tabindex="-1">

                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">

                                        <div class="modal-content border-0 rounded-4 overflow-hidden">

                                            {{-- HEADER --}}
                                            <div class="modal-header bg-primary text-white border-0 p-4">

                                                <div>

                                                    <h3 class="fw-bold mb-1">

                                                        {{ $job->job_title }}

                                                    </h3>

                                                    <p class="mb-0 opacity-75">

                                                        {{ $job->employer->company_name ?? '' }}

                                                    </p>

                                                </div>

                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>

                                            </div>

                                            {{-- BODY --}}
                                            <div class="modal-body p-5">

                                                {{-- INFO --}}
                                                <div class="row g-4 mb-5">

                                                    <div class="col-md-4">

                                                        <div class="bg-light rounded-4 p-4 h-100">

                                                            <small class="text-muted">
                                                                Khu vực
                                                            </small>

                                                            <h6 class="fw-bold mt-2">

                                                                {{ $job->location->location_name ?? '' }}

                                                            </h6>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                        <div class="bg-light rounded-4 p-4 h-100">

                                                            <small class="text-muted">
                                                                Deadline
                                                            </small>

                                                            <h6 class="fw-bold mt-2 text-danger">

                                                                {{ $job->deadline }}

                                                            </h6>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-4">

                                                        <div class="bg-light rounded-4 p-4 h-100">

                                                            <small class="text-muted">
                                                                Trạng thái
                                                            </small>

                                                            <h6 class="fw-bold mt-2">

                                                                @if ($job->status == 1)
                                                                    <span class="text-success">
                                                                        Approved
                                                                    </span>
                                                                @elseif($job->status == 0)
                                                                    <span class="text-warning">
                                                                        Pending
                                                                    </span>
                                                                @else
                                                                    <span class="text-danger">
                                                                        Hidden
                                                                    </span>
                                                                @endif

                                                            </h6>

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- DESCRIPTION --}}
                                                <div class="mb-5">

                                                    <h4 class="fw-bold mb-3">
                                                        Mô tả công việc
                                                    </h4>

                                                    <div class="bg-light rounded-4 p-4">

                                                        {!! nl2br(e($job->job_description)) !!}

                                                    </div>

                                                </div>

                                                {{-- REQUIREMENTS --}}
                                                <div class="mb-5">

                                                    <h4 class="fw-bold mb-3">
                                                        Yêu cầu ứng viên
                                                    </h4>

                                                    <div class="bg-light rounded-4 p-4">

                                                        {!! nl2br(e($job->candidate_requirements)) !!}

                                                    </div>

                                                </div>

                                                {{-- BENEFITS --}}
                                                <div>

                                                    <h4 class="fw-bold mb-3">
                                                        Quyền lợi
                                                    </h4>

                                                    <div class="bg-light rounded-4 p-4">

                                                        {!! nl2br(e($job->benefits)) !!}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png" width="120"
                                            class="mb-3">

                                        <h5 class="fw-bold">
                                            Chưa có job postings
                                        </h5>

                                        <p class="text-muted">
                                            Hiện tại chưa có bài đăng tuyển nào
                                        </p>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
