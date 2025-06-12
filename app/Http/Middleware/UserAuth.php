<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect('/admin/login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        return $next($request);
    }
}

