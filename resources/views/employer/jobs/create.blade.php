@extends('layout.employer')

@section('content')

<style>

.job-form-card{
    background: #fff;
    border-radius: 28px;
    padding: 35px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.05);
}

/* HEADER */
.form-header{
    margin-bottom: 35px;
}

.form-title{
    font-size: 32px;
    font-weight: 700;
    color: #23294a;
}

.form-subtitle{
    color: #888;
    margin-top: 8px;
}

/* SECTION */
.form-section{
    margin-bottom: 35px;
}

.section-title{
    font-size: 20px;
    font-weight: 700;
    color: #23294a;
    margin-bottom: 20px;
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
    border-color: #4cc9f0 !important;

    box-shadow: 0 0 0 4px rgba(76,201,240,0.12) !important;
}

/* TEXTAREA */
textarea.form-control{
    min-height: 160px;
    resize: none;
}

/* BUTTON */
.publish-btn{
    background: linear-gradient(45deg,#4cc9f0,#4361ee);
    border: none;
    border-radius: 16px;

    padding: 14px 30px;

    font-size: 16px;
    font-weight: 600;

    transition: 0.3s;
}

.publish-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(67,97,238,0.25);
}

/* CARD BOX */
.input-card{
    background: #f8f9fc;
    border-radius: 20px;
    padding: 25px;
    height: 100%;
}

/* ICON */
.section-icon{
    width: 48px;
    height: 48px;

    border-radius: 14px;

    background: linear-gradient(45deg,#4cc9f0,#4361ee);

    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 15px;
}

/* INFO */
.helper-text{
    color: #888;
    font-size: 14px;
    margin-top: 5px;
}

</style>

<div class="job-form-card">

    <!-- HEADER -->
    <div class="form-header">

        <div class="form-title">
            Đăng tuyển công việc
        </div>

        <div class="form-subtitle">
            Tạo bài tuyển dụng mới cho doanh nghiệp của bạn
        </div>

    </div>

    <!-- FORM -->
    <form method="POST" action="/employer/jobs/store">

        @csrf

        <!-- BASIC INFO -->
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
                        Điền thông tin cơ bản cho bài tuyển dụng
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
                            class="form-control"
                            name="job_title"
                            placeholder="Ví dụ: Laravel Developer"
                            required>

                    </div>

                </div>

                <!-- CATEGORY -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Ngành nghề
                        </label>

                        <select class="form-select" name="category_id">

                            @foreach($categories as $c)

                                <option value="{{ $c->category_id }}">
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

                        <select class="form-select" name="job_type_id">

                            @foreach($jobTypes as $t)

                                <option value="{{ $t->job_type_id }}">
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

                        <select class="form-select" name="salary_id">

                            @foreach($salaries as $s)

                                <option value="{{ $s->salary_id }}">
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

                        <select class="form-select" name="level_id">

                            @foreach($levels as $l)

                                <option value="{{ $l->level_id }}">
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

                        <select class="form-select" name="location_id">

                            @foreach($locations as $loc)

                                <option value="{{ $loc->location_id }}">
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

                        <select class="form-select" name="workplace">

                            <option value="office">
                                Văn phòng
                            </option>

                            <option value="remote">
                                Remote
                            </option>

                            <option value="hybrid">
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
                            class="form-control"
                            name="quantity"
                            min="1"
                            placeholder="Ví dụ: 5">

                    </div>

                </div>

                <!-- GENDER -->
                <div class="col-md-6">

                    <div class="input-card">

                        <label class="form-label">
                            Giới tính
                        </label>

                        <select class="form-select" name="gender">

                            <option value="any">
                                Không yêu cầu
                            </option>

                            <option value="male">
                                Nam
                            </option>

                            <option value="female">
                                Nữ
                            </option>

                        </select>

                    </div>

                </div>

                <!-- DEADLINE -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Deadline tuyển dụng
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="deadline">

                    </div>

                </div>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="form-section">

            <div class="section-title">
                Mô tả & yêu cầu
            </div>

            <div class="row g-4">

                <!-- DESCRIPTION -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Mô tả công việc
                        </label>

                        <textarea
                            class="form-control"
                            name="job_description"
                            placeholder="Nhập mô tả công việc..."></textarea>

                    </div>

                </div>

                <!-- REQUIREMENTS -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Yêu cầu ứng viên
                        </label>

                        <textarea
                            class="form-control"
                            name="candidate_requirements"
                            placeholder="Nhập yêu cầu ứng viên..."></textarea>

                    </div>

                </div>

                <!-- BENEFITS -->
                <div class="col-md-12">

                    <div class="input-card">

                        <label class="form-label">
                            Quyền lợi
                        </label>

                        <textarea
                            class="form-control"
                            name="benefits"
                            placeholder="Nhập quyền lợi công việc..."></textarea>

                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-4">

            <button class="btn btn-primary publish-btn">

                <i class="fa fa-paper-plane me-2"></i>

                Đăng tuyển ngay

            </button>

        </div>

    </form>

</div>

@endsection