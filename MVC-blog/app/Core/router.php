<?php
namespace App\Core;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    public static function dispatch(string $method, string $uri): void
    {
        // 1/ Khai báo tất cả route
        
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {

            /* ---------- Auth ---------- */
            $r->addRoute('GET',  '/register', 'AuthController@showRegister');
            $r->addRoute('POST', '/register', 'AuthController@register');

            $r->addRoute('GET',  '/login',    'AuthController@showLogin');
            $r->addRoute('POST', '/login',    'AuthController@login');

            $r->addRoute('GET',  '/logout',   'AuthController@logout');

            /* ---------- Bài viết (CRUD) ---------- */
            $r->addRoute('GET',  '/',                      'PostController@index');
            $r->addRoute('GET',  '/posts/create',          'PostController@create');
            $r->addRoute('POST', '/posts',                 'PostController@store');
            $r->addRoute('GET',  '/posts/{id:\d+}/edit',   'PostController@edit');
            $r->addRoute('POST', '/posts/{id:\d+}/update', 'PostController@update');
            $r->addRoute('POST', '/posts/{id:\d+}/delete', 'PostController@destroy');

        });

        /*
        2/ Chuẩn hoá URI
         *      – bỏ query string
         *      – cắt dấu / cuối
         *      – loại bỏ prefix /MVC-blog/public để còn /login, /,...
        */
        $uri = parse_url($uri, PHP_URL_PATH) ?? '/';
        $uri = rtrim($uri, '/') ?: '/';

        // Tự động cắt base path (thư mục chứa index.php)
        $basePath = dirname($_SERVER['SCRIPT_NAME']);   //  /MVC-blog/public
        if ($basePath !== '/' && str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));     //  /login
            $uri = $uri ?: '/';
        }

      
         // 3) Dispatch tới controller phù hợp
        $routeInfo = $dispatcher->dispatch($method, $uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo '404 Not Found';
                return;

            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo '405 Method Not Allowed';
                return;

            case \FastRoute\Dispatcher::FOUND:
                [$ctrl, $action] = explode('@', $routeInfo[1]); // Lấy tên Controller + Method tương ứng
                $vars  = $routeInfo[2];                       // lấy biến {id}
                $class = 'App\\Controllers\\' . $ctrl;

                call_user_func_array([new $class, $action], $vars); // tạo 1 controller mới và gọi đến method tương ứng
                return;
        }
    }
}
