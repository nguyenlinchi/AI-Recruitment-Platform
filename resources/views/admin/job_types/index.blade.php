@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Quản lý loại công việc</h3>

    <!-- BUTTON ADD -->
    <button class="btn btn-primary rounded-3"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
        <i class="fa fa-plus"></i> Thêm loại công việc
    </button>
</div>

<div class="card border-0 shadow rounded-4">

<div class="card-body">

<table class="table align-middle">

    <thead class="table-light">
        <tr>
            <th width="80">ID</th>
            <th>Tên loại công việc</th>
            <th width="180">Hành động</th>
        </tr>
    </thead>

    <tbody>

        @foreach($items as $item)

        <tr>

            <td>
                <span class="badge bg-primary">
                    #{{ $item->job_type_id }}
                </span>
            </td>

            <td class="fw-semibold">
                {{ $item->job_type_name }}
            </td>

            <td>

                <!-- EDIT BUTTON -->
                <button class="btn btn-warning btn-sm rounded-3"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $item->job_type_id }}">
                    <i class="fa fa-pen"></i>
                </button>

                <!-- DELETE -->
                <a href="/admin/job-types/delete/{{ $item->job_type_id }}"
                   class="btn btn-danger btn-sm rounded-3"
                   onclick="return confirm('Xóa loại công việc này?')">
                    <i class="fa fa-trash"></i>
                </a>

            </td>

        </tr>

        <!-- EDIT MODAL -->
        <div class="modal fade"
             id="editModal{{ $item->job_type_id }}"
             tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content rounded-4 border-0">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Chỉnh sửa loại công việc
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST"
                          action="/admin/job-types/update/{{ $item->job_type_id }}">

                        @csrf

                        <div class="modal-body">

                            <label class="mb-2 fw-semibold">
                                Tên loại công việc
                            </label>

                            <input type="text"
                                   name="job_type_name"
                                   class="form-control rounded-3"
                                   value="{{ $item->job_type_name }}"
                                   required>

                        </div>

                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-secondary rounded-3"
                                    data-bs-dismiss="modal">
                                Đóng
                            </button>

                            <button class="btn btn-warning rounded-3">
                                Cập nhật
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </tbody>

</table>

</div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-header">

                <h5 class="modal-title">
                    Thêm loại công việc
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST" action="/admin/job-types/store">

                @csrf

                <div class="modal-body">

                    <label class="mb-2 fw-semibold">
                        Tên loại công việc
                    </label>

                    <input type="text"
                           name="job_type_name"
                           class="form-control rounded-3"
                           placeholder="Nhập tên..."
                           required>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary rounded-3"
                            data-bs-dismiss="modal">
                        Đóng
                    </button>

                    <button class="btn btn-primary rounded-3">
                        Thêm mới
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection