<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user(); // lấy user đang login

        if (! $user || $user->is_admin !== 1) { // nếu chưa đăng nhập & ko phải admin
            return redirect('/') // trả về trang chủ
                ->with('error', 'Forbidden: bạn không có quyền.'); // nhảy thông báo
        }
        return $next($request);
    }
}
