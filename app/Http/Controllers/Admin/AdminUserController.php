<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;

class AdminUserController extends Controller
{
     /**
     * Lấy danh sách tài khoản người dùng kèm thông tin vai trò
     * để hiển thị trên trang quản lý người dùng của Admin.
     */
    public function index()
    {
        $users = Account::with('role')->get();

        return view('admin.users.index', compact('users'));
    }
/**
     * Xóa tài khoản người dùng theo mã tài khoản.
     * Sau khi thực hiện, chuyển về trang trước
     * và gửi kèm thông báo kết quả.
     *$id Mã tài khoản cần xóa
     */
    public function destroy($id)
    {
        Account::destroy($id);

        return back()->with('success', 'Xóa thành công');
    }
}