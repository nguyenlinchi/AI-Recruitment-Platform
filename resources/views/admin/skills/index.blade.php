@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="fw-bold">
        Quản lý Skills
    </h3>

    <!-- BUTTON ADD -->
    <button class="btn btn-primary rounded-3"
            data-bs-toggle="modal"
            data-bs-target="#addModal">

        <i class="fa fa-plus me-1"></i>
        Thêm Skill

    </button>

</div>

<div class="card shadow border-0 rounded-4">

<div class="card-body">

<table class="table align-middle">

<thead class="table-light">

<tr>
    <th width="100">ID</th>
    <th>Skill</th>
    <th width="180">Hành động</th>
</tr>

</thead>

<tbody>

@foreach($items as $item)

<tr>

    <td>
        <span class="badge bg-primary">
            #{{ $item->skill_id }}
        </span>
    </td>

    <td class="fw-semibold">
        {{ $item->skill_name }}
    </td>

    <td>

        <!-- EDIT -->
        <button class="btn btn-warning btn-sm rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#editModal{{ $item->skill_id }}">

            <i class="fa fa-pen"></i>

        </button>

        <!-- DELETE -->
        <a href="/admin/skills/delete/{{ $item->skill_id }}"
           class="btn btn-danger btn-sm rounded-3"
           onclick="return confirm('Xóa skill này?')">

            <i class="fa fa-trash"></i>

        </a>

    </td>

</tr>

<!-- EDIT MODAL -->
<div class="modal fade"
     id="editModal{{ $item->skill_id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-header">

                <h5 class="modal-title">
                    Chỉnh sửa Skill
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST"
                  action="/admin/skills/update/{{ $item->skill_id }}">

                @csrf

                <div class="modal-body">

                    <label class="fw-semibold mb-2">
                        Tên Skill
                    </label>

                    <input type="text"
                           name="skill_name"
                           class="form-control rounded-3"
                           value="{{ $item->skill_name }}"
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
                    Thêm Skill
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST" action="/admin/skills/store">

                @csrf

                <div class="modal-body">

                    <label class="fw-semibold mb-2">
                        Tên Skill
                    </label>

                    <input type="text"
                           name="skill_name"
                           class="form-control rounded-3"
                           placeholder="Nhập skill..."
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