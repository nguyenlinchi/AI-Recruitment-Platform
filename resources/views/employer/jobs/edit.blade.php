@extends('layout.employer')

@section('content')

<style>

.edit-job-card{
    background: #fff;
    border-radius: 28px;
    padding: 35px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.05);
}

/* HEADER */
.edit-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
    flex-wrap: wrap;
    gap: 15px;
}

.edit-title{
    font-size: 32px;
    font-weight: 700;
    color: #23294a;
}

.edit-subtitle{
    color: #888;
    margin-top: 6px;
}

/* SECTION */
.form-section{
    margin-bottom: 35px;
}

.section-title{
    font-size: 20px;
    font-weight: 700;
    color: #23294a;
    margin-bottom: 22px;
}

/* CARD */
.input-card{
    background: #f8f9fc;
    border-radius: 22px;
    padding: 24px;
    height: 100%;
    transition: 0.3s;
}

.input-card:hover{
    transform: translateY(-2px);
}

/* LABEL */
.form-label{
    font-weight: 600;
    color: #444;
    margin-bottom: 8px;
}

/* INPUT */
.form-control,
.form-select{
    border-radius: 14px !important;
    border: 1px solid #e4e7f2 !important;
    min-height: 52px;
    padding: 12px 15px !important;
    box-shadow: none !important;
    transition: 0.3s;
}

.form-control:focus,
.form-select:focus{
    border-color: #4361ee !important;
    box-shadow: 0 0 0 4px rgba(67,97,238,0.10) !important;
}

/* TEXTAREA */
textarea.form-control{
    min-height: 170px;
    resize: none;
}

/* STATUS */
.status-badge{
    padding: 10px 18px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
}

.status-active{
    background: rgba(0,200,83,0.12);
    color: #00a854;
}

.status-hidden{
    background: rgba(120,120,120,0.12);
    color: #666;
}

/* BUTTONS */
.update-btn{
    background: linear-gradient(45deg,#4cc9f0,#4361ee);
    border: none;
    border-radius: 15px;
    padding: 14px 30px;
    font-size: 16px;
    font-weight: 600;
    transition: 0.3s;
}

.update-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(67,97,238,0.25);
}

.back-btn{
    border-radius: 15px;
    padding: 14px 24px;
    font-weight: 600;
}

/* ICON */
.section-icon{
    width: 48px;
    height: 48px;

    border-radius: 15px;

    background: linear-gradient(45deg,#4cc9f0,#4361ee);

    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;
}

.helper-text{
    color: #888;
    font-size: 14px;
    margin-top: 5px;
}

</style>

<nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0 m-0 align-items-center">
            <li class="breadcrumb-item">
                <a href="/employer/jobs" class="text-decoration-none text-muted font-medium">Quản lý công việc</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Chỉnh sửa công việc</li>
        </ol>
    </nav>
<div class="edit-job-card">

    <!-- HEADER -->
    <div class="edit-header">

        <div>

            <div class="edit-title">
                Chỉnh sửa công việc
            </div>

            <div class="edit-subtitle">
                Cập nhật thông tin bài tuyển dụng của bạn
            </div>

        </div>

        <div>

            @if($job->status == 1)

                <span class="status-badge status-active">
                    Active
                </span>

            @else

                <span class="status-badge status-hidden">
                    Hidden
                </span>

            @endif

        </div>

    </div>

    <!-- FORM -->
    <form method="POST" action="/employer/jobs/update/{{ $job->job_id }}">

        @csrf

        <!-- THÔNG TIN -->
        <div class="form-section">

            <div class="d-flex align-items-center gap-3 mb-4">

                <div class="section-icon">
                    <i class="fa fa-briefcase"></i>
                </div>

                <div>

                    <div class="section-title mb-0">
                        Thông tin công việc
                    </div>

                    <div class="helper-text">
                        Cập nhật thông tin cơ bản của bài tuyển dụng
                    </div>

                </div>

            </div>

            <div class="row g-4">

                <!-- TITLE -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Tiêu đề công việc
                        </label>

                        <input
                            type="text"
                            name="job_title"
                            class="form-control"
                            value="{{ old('job_title', $job->job_title) }}">

                    </div>

                </div>

                <!-- CATEGORY -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Ngành nghề
                        </label>

                        <select name="category_id" class="form-select">

                            @foreach($categories as $c)

                                <option value="{{ $c->category_id }}"
                                    {{ $job->category_id == $c->category_id ? 'selected' : '' }}>

                                    {{ $c->category_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- JOB TYPE -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Loại công việc
                        </label>

                        <select name="job_type_id" class="form-select">

                            @foreach($jobTypes as $t)

                                <option value="{{ $t->job_type_id }}"
                                    {{ $job->job_type_id == $t->job_type_id ? 'selected' : '' }}>

                                    {{ $t->job_type_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- SALARY -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Mức lương
                        </label>

                        <select name="salary_id" class="form-select">

                            @foreach($salaries as $s)

                                <option value="{{ $s->salary_id }}"
                                    {{ $job->salary_id == $s->salary_id ? 'selected' : '' }}>

                                    {{ $s->salary_range }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- LEVEL -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Level
                        </label>

                        <select name="level_id" class="form-select">

                            @foreach($levels as $l)

                                <option value="{{ $l->level_id }}"
                                    {{ $job->level_id == $l->level_id ? 'selected' : '' }}>

                                    {{ $l->level_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- LOCATION -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Khu vực
                        </label>

                        <select name="location_id" class="form-select">

                            @foreach($locations as $loc)

                                <option value="{{ $loc->location_id }}"
                                    {{ $job->location_id == $loc->location_id ? 'selected' : '' }}>

                                    {{ $loc->location_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- WORKPLACE -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Hình thức làm việc
                        </label>

                        <select name="workplace" class="form-select">

                            <option value="office" {{ $job->workplace == 'office' ? 'selected' : '' }}>
                                Văn phòng
                            </option>

                            <option value="remote" {{ $job->workplace == 'remote' ? 'selected' : '' }}>
                                Remote
                            </option>

                            <option value="hybrid" {{ $job->workplace == 'hybrid' ? 'selected' : '' }}>
                                Hybrid
                            </option>

                        </select>

                    </div>

                </div>

                <!-- QUANTITY -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Số lượng tuyển
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="form-control"
                            value="{{ old('quantity', $job->quantity) }}">

                    </div>

                </div>

                <!-- GENDER -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Giới tính
                        </label>

                        <select name="gender" class="form-select">

                            <option value="any" {{ $job->gender == 'any' ? 'selected' : '' }}>
                                Không yêu cầu
                            </option>

                            <option value="male" {{ $job->gender == 'male' ? 'selected' : '' }}>
                                Nam
                            </option>

                            <option value="female" {{ $job->gender == 'female' ? 'selected' : '' }}>
                                Nữ
                            </option>

                        </select>

                    </div>

                </div>

                <!-- DEADLINE -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            class="form-control"
                            value="{{ old('deadline', $job->deadline) }}">

                    </div>

                </div>

                <!-- STATUS -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Trạng thái
                        </label>

                        <select name="status" class="form-select">

                            <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>
                                Hidden
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <!-- MÔ TẢ -->
        <div class="form-section">

            <div class="section-title">
                Nội dung tuyển dụng
            </div>

            <div class="row g-4">

                <!-- DESCRIPTION -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Mô tả công việc
                        </label>

                        <textarea
                            name="job_description"
                            class="form-control"
                            rows="4">{{ old('job_description', $job->job_description) }}</textarea>

                    </div>

                </div>

                <!-- REQUIREMENTS -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Yêu cầu ứng viên
                        </label>

                        <textarea
                            name="candidate_requirements"
                            class="form-control"
                            rows="4">{{ old('candidate_requirements', $job->candidate_requirements) }}</textarea>

                    </div>

                </div>

                <!-- BENEFITS -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Quyền lợi
                        </label>

                        <textarea
                            name="benefits"
                            class="form-control"
                            rows="4">{{ old('benefits', $job->benefits) }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="d-flex gap-3 mt-4">

            <button class="btn btn-primary update-btn">

                <i class="fa fa-save me-2"></i>

                Cập nhật công việc

            </button>

            <a href="/employer/jobs"
               class="btn btn-light back-btn">

                <i class="fa fa-arrow-left me-2"></i>

                Quay lại

            </a>

        </div>

    </form>

</div>

@endsection