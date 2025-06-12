<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/admin/login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        return $next($request);
    }
}

