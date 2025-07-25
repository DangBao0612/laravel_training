<?php
require __DIR__.'/../bootstrap.php';                 // nạp mọi thứ
App\Core\Router::dispatch($_SERVER['REQUEST_METHOD'],
                          $_SERVER['REQUEST_URI']);  // gửi về Router
