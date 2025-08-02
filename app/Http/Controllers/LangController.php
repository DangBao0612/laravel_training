<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session; 

class LangController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        // Chỉ cho phép en | vi
        if (! in_array($locale, ['en', 'vi'])) {
            $locale = config('app.locale');   // về mặc định
        }

        Session::put('locale', $locale);      // lưu vào session
        App::setLocale($locale);              // áp dụng ngay

        return back();                        // quay về trang trước
    }
}
