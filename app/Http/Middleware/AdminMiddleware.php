<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Dùng hàm isAdmin() đã có trong model User
        if (!$user->isAdmin()) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        return $next($request);
    }
}
