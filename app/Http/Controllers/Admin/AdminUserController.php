<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = Account::with('role')->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        Account::destroy($id);

        return back()->with('success', 'Xóa thành công');
    }
}