@extends('layout.header')

@section('content')

<div class="container py-5">

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-5">

            <h2 class="fw-bold text-primary">
                {{ $resume->resume_title }}
            </h2>

            <hr>

            <h5>Mục tiêu nghề nghiệp</h5>
            <p>{{ $resume->career_objective }}</p>

            <h5>Kinh nghiệm</h5>
            <p>{{ $resume->experience }}</p>

            <h5>Học vấn</h5>
            <p>{{ $resume->education }}</p>

            <h5>Kỹ năng mềm</h5>
            <p>{{ $resume->soft_skills }}</p>

            <h5>Giải thưởng</h5>
            <p>{{ $resume->awards }}</p>

            <div class="mt-4">
                <a href="{{ route('resume.edit', $resume->resume_id) }}"
                    class="btn btn-primary">
                    Chỉnh sửa
                </a>

                <a href="{{ route('profile') }}"
                    class="btn btn-secondary">
                    Quay lại
                </a>
            </div>

        </div>
    </div>

</div>

@endsection