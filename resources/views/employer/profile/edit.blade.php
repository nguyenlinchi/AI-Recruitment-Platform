@extends('layout.employer')

@section('content')

<style>

.edit-card{
    background: #fff;
    border-radius: 25px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

/* HEADER */
.page-title{
    font-size: 30px;
    font-weight: 700;
    color: #23294a;
}

.page-subtitle{
    color: #888;
    margin-top: 5px;
    margin-bottom: 30px;
}

/* SECTION */
.section-title{
    font-size: 20px;
    font-weight: 700;
    color: #23294a;
    margin-bottom: 20px;
}

/* INPUT */
.form-label{
    font-weight: 600;
    color: #444;
    margin-bottom: 8px;
}

.form-control{
    border-radius: 14px !important;
    border: 1px solid #e4e7f2 !important;
    padding: 12px 15px !important;
    min-height: 50px;
    box-shadow: none !important;
}

.form-control:focus{
    border-color: #4cc9f0 !important;
    box-shadow: 0 0 0 4px rgba(76,201,240,0.12) !important;
}

/* TEXTAREA */
textarea.form-control{
    min-height: 140px;
    resize: none;
}

/* IMAGE CARD */
.image-card{
    background: #f8f9fc;
    border-radius: 20px;
    padding: 20px;
    text-align: center;
    height: 100%;
}

.image-title{
    font-weight: 700;
    margin-bottom: 15px;
    color: #23294a;
}

.avatar-preview{
    width: 140px;
    height: 140px;

    border-radius: 50%;
    object-fit: cover;

    border: 5px solid #fff;

    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.cover-preview{
    width: 100%;
    height: 180px;

    border-radius: 18px;
    object-fit: cover;

    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

/* BUTTON */
.save-btn{
    background: linear-gradient(45deg,#4cc9f0,#4361ee);
    border: none;
    border-radius: 14px;

    padding: 14px 30px;

    font-size: 16px;
    font-weight: 600;

    transition: 0.3s;
}

.save-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(67,97,238,0.2);
}

/* FILE INPUT */
input[type=file]{
    padding: 10px !important;
}

</style>

<div class="edit-card">

    <!-- TITLE -->
    <div class="mb-4">

        <div class="page-title">
            Chỉnh sửa thông tin công ty
        </div>

        <div class="page-subtitle">
            Cập nhật hồ sơ doanh nghiệp của bạn
        </div>

    </div>

    <form method="POST"
          action="/employer/profile/update"
          enctype="multipart/form-data">

        @csrf

        <!-- COMPANY INFO -->
        <div class="section-title">
            Thông tin công ty
        </div>

        <div class="row">

            <div class="col-md-6 mb-4">
                <label class="form-label">Tên công ty</label>
                <input
                    class="form-control"
                    name="company_name"
                    value="{{ $employer->company_name }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Người liên hệ</label>
                <input
                    class="form-control"
                    name="contact_name"
                    value="{{ $employer->contact_name }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Chức vụ</label>
                <input
                    class="form-control"
                    name="position"
                    value="{{ $employer->position }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Số điện thoại</label>
                <input
                    class="form-control"
                    name="phone"
                    value="{{ $employer->phone }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Website</label>
                <input
                    class="form-control"
                    name="website"
                    value="{{ $employer->website }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Địa điểm</label>
                <input
                    class="form-control"
                    name="location"
                    value="{{ $employer->location }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Quy mô công ty</label>
                <input
                    class="form-control"
                    name="company_size"
                    value="{{ $employer->company_size }}">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Năm thành lập</label>
                <input
                    class="form-control"
                    name="founded_year"
                    value="{{ $employer->founded_year }}">
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Mô tả công ty</label>

                <textarea
                    class="form-control"
                    name="description">{{ $employer->description }}</textarea>
            </div>

        </div>

        <!-- IMAGE -->
        <div class="section-title mt-3">
            Hình ảnh công ty
        </div>

        <div class="row">

            <!-- AVATAR -->
            <div class="col-md-4 mb-4">

                <div class="image-card">

                    <div class="image-title">
                        Avatar công ty
                    </div>

                    @if($employer->avatar)

                        <img
                            id="avatarPreview"
                            src="{{ $employer->avatar }}"
                            class="avatar-preview">

                    @else

                        <img
                            id="avatarPreview"
                            src="https://via.placeholder.com/140"
                            class="avatar-preview">

                    @endif

                    <div class="mt-4">

                        <input
                            type="file"
                            name="avatar"
                            class="form-control"
                            onchange="previewAvatar(event)">

                    </div>

                </div>

            </div>

            <!-- COVER -->
            <div class="col-md-8 mb-4">

                <div class="image-card">

                    <div class="image-title">
                        Ảnh bìa công ty
                    </div>

                    @if($employer->cover_image)

                        <img
                            id="coverPreview"
                            src="{{ $employer->cover_image }}"
                            class="cover-preview">

                    @else

                        <img
                            id="coverPreview"
                            src="https://via.placeholder.com/900x180"
                            class="cover-preview">

                    @endif

                    <div class="mt-4">

                        <input
                            type="file"
                            name="cover_image"
                            class="form-control"
                            onchange="previewCover(event)">

                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-4">

            <button class="btn btn-primary save-btn">

                <i class="fa fa-save me-2"></i>

                Cập nhật thông tin

            </button>

        </div>

    </form>

</div>

<script>

function previewAvatar(event){

    const reader = new FileReader();

    reader.onload = function(){

        document
            .getElementById('avatarPreview')
            .src = reader.result;

    }

    reader.readAsDataURL(event.target.files[0]);

}

function previewCover(event){

    const reader = new FileReader();

    reader.onload = function(){

        document
            .getElementById('coverPreview')
            .src = reader.result;

    }

    reader.readAsDataURL(event.target.files[0]);

}

</script>

@endsection