<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Xác thực xem người dùng đã đăng nhập hay chưa
        if(!FacadesAuth::check()){
            return redirect('/login');
        }
        //Kiểm tra xem người dùng có phải là admin hay không
        if(Auth::user()->role !== 'admin'){
            return redirect('/')->with('error','Bạn không có quyền truy cập vào trang này.');
        }
        return $next($request);
    }
}
