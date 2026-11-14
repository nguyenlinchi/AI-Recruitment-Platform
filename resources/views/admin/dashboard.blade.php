@extends('layout.admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Tổng quan hệ thống tuyển dụng
        </p>
    </div>

</div>

{{-- STATS --}}
<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow rounded-4 p-4 bg-primary text-white">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-2">
                        Tổng Users
                    </p>

                    <h2 class="fw-bold">
                        {{ $users }}
                    </h2>
                </div>

                <div class="fs-1 opacity-50">
                    <i class="fa fa-users"></i>
                </div>

            </div>

        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow rounded-4 p-4 bg-success text-white">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-2">
                        Job Postings
                    </p>

                    <h2 class="fw-bold">
                        {{ $jobs }}
                    </h2>
                </div>

                <div class="fs-1 opacity-50">
                    <i class="fa fa-briefcase"></i>
                </div>

            </div>

        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow rounded-4 p-4 bg-warning text-dark">

            <div class="d-flex justify-content-between">

                <div>
                    <p class="mb-2">
                        Career Guides
                    </p>

                    <h2 class="fw-bold">
                        {{ $careers }}
                    </h2>
                </div>

                <div class="fs-1 opacity-50">
                    <i class="fa fa-book"></i>
                </div>

            </div>

        </div>
    </div>


</div>

{{-- CHARTS --}}
<div class="row g-4 mb-4">

    {{-- JOB STATUS --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow rounded-4 h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Trạng thái Job
                </h5>

                <canvas id="jobChart"></canvas>

            </div>

        </div>

    </div>

    {{-- APPLICATION --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow rounded-4 h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Applications
                </h5>

                <canvas id="applicationChart"></canvas>

            </div>

        </div>

    </div>

    {{-- OVERVIEW --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow rounded-4 h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    System Overview
                </h5>

                <canvas id="overviewChart"></canvas>

            </div>

        </div>

    </div>

</div>

{{-- JOB POSTINGS TABLE --}}
<div class="card border-0 shadow rounded-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Job Postings
                </h4>

                <p class="text-muted mb-0">
                    Danh sách bài tuyển dụng mới nhất
                </p>
            </div>

            <a href="/admin/jobs" class="btn btn-primary rounded-pill px-4">
                Xem tất cả
            </a>

        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Công việc</th>
                        <th>Công ty</th>
                        <th>Khu vực</th>
                        <th>Deadline</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($latestJobs as $job)

                    <tr>

                        <td>
                            #{{ $job->job_id }}
                        </td>

                        <td>

                            <div class="fw-bold">
                                {{ $job->job_title }}
                            </div>

                            <small class="text-muted">
                                {{ $job->category->category_name ?? '' }}
                            </small>

                        </td>

                        <td>
                            {{ $job->employer->company_name ?? '' }}
                        </td>

                        <td>
                            {{ $job->location->location_name ?? '' }}
                        </td>

                        <td>
                            {{ $job->deadline }}
                        </td>

                        <td>

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

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- CHART JS --}}
<script>

    // JOB CHART
    new Chart(document.getElementById('jobChart'), {

        type: 'doughnut',

        data: {
            labels: ['Approved', 'Pending', 'Hidden'],
            datasets: [{
                data: [
                    {{ $approvedJobs }},
                    {{ $pendingJobs }},
                    {{ $hiddenJobs }}
                ],
                backgroundColor: [
                    '#22c55e',
                    '#facc15',
                    '#ef4444'
                ]
            }]
        }

    });

    // APPLICATION CHART
    new Chart(document.getElementById('applicationChart'), {

        type: 'bar',

        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                label: 'Applications',
                data: [
                    {{ $pendingApplications }},
                    {{ $approvedApplications }},
                    {{ $rejectedApplications }}
                ],
                backgroundColor: [
                    '#facc15',
                    '#22c55e',
                    '#ef4444'
                ],
                borderRadius: 10
            }]
        }

    });

    // OVERVIEW
    new Chart(document.getElementById('overviewChart'), {

        type: 'line',

        data: {
            labels: ['Users', 'Jobs', 'Careers'],
            datasets: [{
                label: 'Overview',
                data: [
                    {{ $users }},
                    {{ $jobs }},
                    {{ $careers }},
                ],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.2)',
                fill: true,
                tension: 0.4
            }]
        }

    });

</script>

@endsection