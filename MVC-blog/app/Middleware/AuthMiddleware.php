<?php
namespace App\Middleware;

class AuthMiddleware
{
    public static function handle()
    {
        if (empty($_SESSION['uid'])) { // kiểm tra đăng nhập (ko)
            header('Location: ' . BASE_URI . '/login'); // Nếu chưa, chặn flow, chuyển hướng về login
            exit;
        }
    }
}
