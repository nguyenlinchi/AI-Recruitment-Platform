@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Quản lý Users
        </h2>

        <p class="text-muted mb-0">
            Danh sách tài khoản hệ thống
        </p>
    </div>

</div>

{{-- SUCCESS --}}
@if(session('success'))

<div class="alert alert-success rounded-4 shadow-sm border-0">
    {{ session('success') }}
</div>

@endif

<div class="card border-0 shadow rounded-4">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle table-hover">

                <thead class="table-light">

                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="120">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr>

                        {{-- ID --}}
                        <td>
                            #{{ $user->account_id }}
                        </td>

                        {{-- USER --}}
                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff"
                                     width="45"
                                     height="45"
                                     class="rounded-circle shadow-sm">

                                <div>

                                    <div class="fw-semibold">
                                        {{ $user->name }}
                                    </div>

                                    <small class="text-muted">
                                        Created:
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                    </small>

                                </div>

                            </div>

                        </td>

                        {{-- EMAIL --}}
                        <td>
                            {{ $user->email }}
                        </td>

                        {{-- ROLE --}}
                        <td>

                            @if($user->role->role_name == 'ADMIN')

                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    ADMIN
                                </span>

                            @elseif($user->role->role_name == 'EMPLOYER')

                                <span class="badge bg-primary px-3 py-2 rounded-pill">
                                    EMPLOYER
                                </span>

                            @else

                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    CANDIDATE
                                </span>

                            @endif

                        </td>

                        {{-- ACTION --}}
                        <td>

                            @if($user->role->role_name != 'ADMIN')

                            <a href="/admin/users/delete/{{ $user->account_id }}"
                               class="btn btn-danger btn-sm rounded-pill px-3"
                               onclick="return confirm('Bạn có chắc muốn xóa user này?')">

                                <i class="fa fa-trash me-1"></i>
                                Xóa

                            </a>

                            @else

                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>

                                <i class="fa fa-lock me-1"></i>
                                Admin

                            </button>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-5 text-muted">

                            <i class="fa fa-users fa-3x mb-3"></i>

                            <div>
                                Không có dữ liệu users
                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection