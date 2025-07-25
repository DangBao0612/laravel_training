<?php
namespace App\Middleware;

class GuestMiddleware
{
    public static function handle()
    {
        if (!empty($_SESSION['uid'])) {
            header('Location: ' . BASE_URI . '/');
            exit;
        }
    }
}
