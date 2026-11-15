@extends('layout.employer')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Quản lý ứng viên</h3>
        <p class="text-muted mb-0">
            Danh sách ứng viên đã apply vào công việc của bạn
        </p>
    </div>
</div>

<!-- SEARCH -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <form method="GET" action="/employer/applications">

            <div class="row">

                <!-- Search Candidate -->
                <div class="col-md-5 mb-2">
                    <label class="form-label">Tên ứng viên</label>

                    <input type="text"
                           name="candidate"
                           class="form-control"
                           placeholder="Nhập tên ứng viên..."
                           value="{{ request('candidate') }}">
                </div>

                <!-- Search Job -->
                <div class="col-md-5 mb-2">
                    <label class="form-label">Tên công việc</label>

                    <input type="text"
                           name="job"
                           class="form-control"
                           placeholder="Nhập tên job..."
                           value="{{ request('job') }}">
                </div>

                <!-- Button -->
                <div class="col-md-2 d-flex align-items-end mb-2">
                    <button class="btn btn-primary w-100">
                        <i class="fa fa-search me-2"></i>
                        Tìm kiếm
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>

<!-- TABLE -->
<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle table-hover">

                <thead class="table-light">
                <tr>
                    <th>Ứng viên</th>
                    <th>Công việc</th>
                    <th>Ngày apply</th>
                    <th>Trạng thái</th>
                    <th width="120"></th>
                </tr>
                </thead>

                <tbody>

                @forelse($applications as $a)

                    <tr>

                        <!-- Candidate -->
                        <td>

                            <div class="d-flex align-items-center">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($a->candidate->full_name) }}&background=6c5ce7&color=fff"
                                     width="45"
                                     height="45"
                                     class="rounded-circle me-3">

                                <div>
                                    <div class="fw-semibold">
                                        {{ $a->candidate->full_name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $a->candidate->account->email ?? '' }}
                                    </small>
                                </div>

                            </div>

                        </td>

                        <!-- Job -->
                        <td>
                            <div class="fw-semibold">
                                {{ $a->job->job_title }}
                            </div>
                        </td>

                        <!-- Date -->
                        <td>
                            {{ $a->applied_date }}
                        </td>

                        <!-- Status -->
                        <td>

                            @if($a->status == 0)
                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @elseif($a->status == 1)

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            @endif

                        </td>

                        <!-- Action -->
                        <td>

                            <a href="/employer/applications/{{ $a->application_id }}"
                               class="btn btn-primary btn-sm">

                                <i class="fa fa-eye me-1"></i>
                                Xem

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Không có ứng viên nào
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection