<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
         // Lấy locale lưu trong session (hoặc rơi về giá trị mặc định)
        $locale = session('locale', config('app.locale'));

        // Chỉ chấp nhận 'en' hoặc 'vi'
        if (!in_array($locale, ['en', 'vi'])) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
