<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // chưa đăng nhập
        if (!Auth::check()) {
            return redirect('/login');
        }

        // sai quyền
        if (Auth::user()->role->role_name != $role) {
            abort(403, 'Không có quyền');
        }

        return $next($request);
    }
}
