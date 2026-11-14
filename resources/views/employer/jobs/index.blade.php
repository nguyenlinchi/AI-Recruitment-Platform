@extends('layout.employer')

@section('content')

    <style>
        .jobs-card {
            background: #fff;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* HEADER */
        .jobs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .jobs-title {
            font-size: 30px;
            font-weight: 700;
            color: #23294a;
        }

        .jobs-subtitle {
            color: #888;
            margin-top: 5px;
        }

        /* SEARCH */
        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
        }

        .search-input {
            height: 50px;
            border-radius: 14px;
            border: 1px solid #eee;
            padding-left: 45px;
        }

        .search-input:focus {
            box-shadow: none;
            border-color: #4361ee;
        }

        .filter-select {
            height: 50px;
            border-radius: 14px;
            border: 1px solid #eee;
        }

        .search-btn {
            height: 50px;
            border-radius: 14px;
        }

        .reset-btn {
            height: 50px;
            border-radius: 14px;
        }

        /* ADD BUTTON */
        .add-job-btn {
            background: linear-gradient(45deg, #4cc9f0, #4361ee);
            border: none;
            border-radius: 14px;

            padding: 12px 22px;

            font-size: 15px;
            font-weight: 600;

            transition: 0.3s;
        }

        .add-job-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        }

        /* TABLE */
        .jobs-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .jobs-table thead th {
            border: none;
            color: #888;
            font-size: 14px;
            font-weight: 600;
            padding: 0 20px;
        }

        .jobs-table tbody tr {
            background: #f8f9fc;
            transition: 0.3s;
        }

        .jobs-table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .jobs-table td {
            padding: 20px;
            vertical-align: middle;
            border: none;
        }

        .jobs-table tbody tr td:first-child {
            border-radius: 18px 0 0 18px;
        }

        .jobs-table tbody tr td:last-child {
            border-radius: 0 18px 18px 0;
        }

        /* JOB TITLE */
        .job-title {
            font-size: 16px;
            font-weight: 700;
            color: #23294a;
        }

        .job-date {
            color: #666;
            font-size: 14px;
        }

        /* STATUS */
        .status-badge {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(0, 200, 83, 0.12);
            color: #00a854;
        }

        .status-hidden {
            background: rgba(120, 120, 120, 0.12);
            color: #666;
        }

        /* ACTION BUTTONS */
        .action-btn {
            width: 38px;
            height: 38px;

            border-radius: 12px;
            border: none;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            transition: 0.3s;
        }

        .edit-btn {
            background: rgba(255, 193, 7, 0.12);
            color: #f59f00;
        }

        .edit-btn:hover {
            background: #f59f00;
            color: #fff;
        }

        .delete-btn {
            background: rgba(244, 67, 54, 0.12);
            color: #f44336;
        }

        .delete-btn:hover {
            background: #f44336;
            color: #fff;
        }

        /* EMPTY */
        .empty-box {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-box i {
            font-size: 70px;
            color: #d0d7e2;
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 22px;
            font-weight: 700;
            color: #23294a;
        }

        .empty-subtitle {
            color: #888;
            margin-top: 10px;
        }
    </style>

    <div class="jobs-card">

        <!-- HEADER -->
        <div class="jobs-header">

            <div>

                <div class="jobs-title">
                    Quản lý công việc
                </div>

                <div class="jobs-subtitle">
                    Danh sách các bài tuyển dụng của bạn
                </div>

            </div>

            <a href="/employer/jobs/create" class="btn btn-primary add-job-btn">

                <i class="fa fa-plus me-2"></i>

                Đăng tin tuyển dụng

            </a>

        </div>

        <!-- SEARCH -->
        <form method="GET" action="/employer/jobs">

            <div class="row mb-4">

                <!-- SEARCH -->
                <div class="col-md-5">

                    <div class="search-box">

                        <i class="fa fa-search"></i>

                        <input type="text" name="keyword" class="form-control search-input"
                            placeholder="Tìm kiếm công việc..." value="{{ request('keyword') }}">

                    </div>

                </div>

                <!-- STATUS -->
                <div class="col-md-3">

                    <select name="status" class="form-select filter-select">

                        <option value="">
                            Tất cả trạng thái
                        </option>

                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                            Hidden
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="col-md-2">

                    <button class="btn btn-primary w-100 search-btn">

                        <i class="fa fa-search me-2"></i>

                        Tìm kiếm

                    </button>

                </div>

                <!-- RESET -->
                <div class="col-md-2">

                    <a href="/employer/jobs" class="btn btn-light w-100 reset-btn">

                        Reset

                    </a>

                </div>

            </div>

        </form>

        <!-- TABLE -->
        @if ($jobs->count() > 0)
            <table class="jobs-table">

                <thead>
                    <tr>
                        <th>Công việc</th>
                        <th>Deadline</th>
                        <th>Trạng thái</th>
                        <th width="120">Hành động</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($jobs as $job)
                        <tr>

                            <td>

                                <div class="job-title">
                                    {{ $job->job_title }}
                                </div>

                            </td>

                            <td>

                                <div class="job-date">
                                    <i class="fa fa-calendar me-2"></i>

                                    {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                                </div>

                            </td>

                            <td>

                                @if ($job->status == 1)
                                    <span class="status-badge status-active">
                                        Active
                                    </span>
                                @else
                                    <span class="status-badge status-hidden">
                                        Hidden
                                    </span>
                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <!-- EDIT -->
                                    <a href="/employer/jobs/edit/{{ $job->job_id }}" class="action-btn edit-btn">

                                        <i class="fa fa-pen"></i>

                                    </a>

                                    <!-- DELETE -->
                                    <form method="POST" action="/employer/jobs/delete/{{ $job->job_id }}">

                                        @csrf
                                        @method('DELETE')

                                        <button class="action-btn delete-btn">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        @else
            <!-- EMPTY -->
            <div class="empty-box">

                <i class="fa fa-briefcase"></i>

                <div class="empty-title">
                    Chưa có bài tuyển dụng nào
                </div>

                <div class="empty-subtitle">
                    Hãy tạo bài đăng đầu tiên của bạn
                </div>

            </div>
        @endif

    </div>

@endsection
