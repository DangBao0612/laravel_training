<?php
namespace App\Sub;

const text= "Hello from sub";
function hello(){
    echo "Gọi từ App/Sub/hello()<br>";
}

class hi {
    public static function say(){
        echo "Gọi từ App/Sub/hi::say()<br>";
    }
}
