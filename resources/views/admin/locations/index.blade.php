@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="fw-bold">
        Quản lý Locations
    </h3>

    <!-- BUTTON ADD -->
    <button class="btn btn-primary rounded-3"
            data-bs-toggle="modal"
            data-bs-target="#addModal">

        <i class="fa fa-plus me-1"></i>
        Thêm Location

    </button>

</div>

<div class="card shadow border-0 rounded-4">

<div class="card-body">

<table class="table align-middle">

<thead class="table-light">

<tr>
    <th width="100">ID</th>
    <th>Khu vực</th>
    <th width="180">Hành động</th>
</tr>

</thead>

<tbody>

@foreach($items as $item)

<tr>

    <td>
        <span class="badge bg-primary">
            #{{ $item->location_id }}
        </span>
    </td>

    <td class="fw-semibold">
        {{ $item->location_name }}
    </td>

    <td>

        <!-- EDIT -->
        <button class="btn btn-warning btn-sm rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#editModal{{ $item->location_id }}">

            <i class="fa fa-pen"></i>

        </button>

        <!-- DELETE -->
        <a href="/admin/locations/delete/{{ $item->location_id }}"
           class="btn btn-danger btn-sm rounded-3"
           onclick="return confirm('Xóa location này?')">

            <i class="fa fa-trash"></i>

        </a>

    </td>

</tr>

<!-- EDIT MODAL -->
<div class="modal fade"
     id="editModal{{ $item->location_id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-header">

                <h5 class="modal-title">
                    Chỉnh sửa Location
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST"
                  action="/admin/locations/update/{{ $item->location_id }}">

                @csrf

                <div class="modal-body">

                    <label class="fw-semibold mb-2">
                        Tên khu vực
                    </label>

                    <input type="text"
                           name="location_name"
                           class="form-control rounded-3"
                           value="{{ $item->location_name }}"
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
                    Thêm Location
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST" action="/admin/locations/store">

                @csrf

                <div class="modal-body">

                    <label class="fw-semibold mb-2">
                        Tên khu vực
                    </label>

                    <input type="text"
                           name="location_name"
                           class="form-control rounded-3"
                           placeholder="Nhập khu vực..."
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