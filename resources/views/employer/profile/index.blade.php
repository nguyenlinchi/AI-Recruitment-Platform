@extends('layout.employer')

@section('content')

<style>

.profile-card{
    background: #fff;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

/* COVER */
.profile-cover{
    width: 100%;
    height: 260px;
    object-fit: cover;
}

/* HEADER */
.profile-header{
    position: relative;
    padding: 0 40px 40px;
}

/* AVATAR */
.profile-avatar{
    width: 140px;
    height: 140px;

    border-radius: 50%;
    object-fit: cover;

    border: 6px solid #fff;

    margin-top: -70px;

    background: #fff;

    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

/* COMPANY */
.company-name{
    font-size: 30px;
    font-weight: 700;
    color: #23294a;
    margin-top: 15px;
}

.company-location{
    color: #777;
    font-size: 15px;
}

/* BUTTON */
.edit-btn{
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
}

/* INFO BOX */
.info-box{
    background: #f8f9fc;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
}

.info-title{
    font-size: 14px;
    color: #888;
    margin-bottom: 8px;
}

.info-value{
    font-size: 17px;
    font-weight: 600;
    color: #23294a;
}

/* DESCRIPTION */
.description-box{
    background: #f8f9fc;
    border-radius: 20px;
    padding: 25px;
}

.description-title{
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #23294a;
}

.description-text{
    color: #555;
    line-height: 1.8;
}

/* ICON */
.info-icon{
    width: 45px;
    height: 45px;

    border-radius: 12px;

    background: #4cc9f0;

    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 15px;
}

</style>

<div class="profile-card">

    <!-- COVER -->
    @if($employer->cover_image)

        <img
            src="{{ $employer->cover_image }}"
            class="profile-cover">

    @else

        <img
            src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=1600"
            class="profile-cover">

    @endif

    <!-- HEADER -->
    <div class="profile-header">

        <div class="d-flex justify-content-between align-items-start flex-wrap">

            <div>

                <!-- AVATAR -->
                @if($employer->avatar)

                    <img
                        src="{{ $employer->avatar }}"
                        class="profile-avatar">

                @else

                    <img
                        src="https://via.placeholder.com/140"
                        class="profile-avatar">

                @endif

                <!-- COMPANY -->
                <div class="company-name">
                    {{ $employer->company_name }}
                </div>

                <div class="company-location">
                    <i class="fa fa-location-dot me-2"></i>
                    {{ $employer->location }}
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-4">

                <a href="/employer/profile/edit"
                   class="btn btn-primary edit-btn">

                    <i class="fa fa-pen me-2"></i>
                    Chỉnh sửa

                </a>

            </div>

        </div>

        <!-- INFO -->
        <div class="row mt-5 g-4">

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="info-title">
                        Người liên hệ
                    </div>

                    <div class="info-value">
                        {{ $employer->contact_name }}
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-briefcase"></i>
                    </div>

                    <div class="info-title">
                        Chức vụ
                    </div>

                    <div class="info-value">
                        {{ $employer->position }}
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="info-title">
                        Số điện thoại
                    </div>

                    <div class="info-value">
                        {{ $employer->phone }}
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-globe"></i>
                    </div>

                    <div class="info-title">
                        Website
                    </div>

                    <div class="info-value">
                        {{ $employer->website }}
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-building"></i>
                    </div>

                    <div class="info-title">
                        Quy mô công ty
                    </div>

                    <div class="info-value">
                        {{ $employer->company_size }}
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="fa fa-calendar"></i>
                    </div>

                    <div class="info-title">
                        Năm thành lập
                    </div>

                    <div class="info-value">
                        {{ $employer->founded_year }}
                    </div>

                </div>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="description-box mt-5">

            <div class="description-title">
                Giới thiệu công ty
            </div>

            <div class="description-text">
                {{ $employer->description }}
            </div>

        </div>

    </div>

</div>

@endsection