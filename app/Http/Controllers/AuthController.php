<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Role;
use App\Models\Candidate;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= HIỂN THỊ FORM =================
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $role = Role::where('role_name', $request->role)->first();

        if (!$role) {
            return back()->with('error', 'Role không tồn tại');
        }

        $account = Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->role_id
        ]);

        if ($request->role == 'CANDIDATE') {
            Candidate::create([
                'account_id' => $account->account_id
            ]);
        } elseif ($request->role == 'EMPLOYER') {
            Employer::create([
                'account_id' => $account->account_id
            ]);
        }

        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }

    // ================= LOGIN =================
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $role = $user->role->role_name;

            if ($role == 'ADMIN') {
                return redirect('/admin/dashboard');
            } elseif ($role == 'EMPLOYER') {
                return redirect('/employer/dashboard');
            } else {
                return redirect('/candidate/home');
            }
        }

        return back()->with('error', 'Sai email hoặc mật khẩu');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}