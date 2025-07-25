<?php
namespace App;

include 'subspace.php'; // Include file sub vào

const text = "Hello from app";

function hello (){ // tên function trùng với function trong file sub
    echo "Gọi từ App\hello()<br>";
}

class hi {
    public static function say(){
        echo "Gọi từ App\hi::say()<br>";
    }
}

// Unqualified name
hello(); //App\hello
hi::say(); //App\hi::say();
echo text . "<br>"; //App\text

//Qualified name (namespace con)
Sub\hello(); //App\Sub\hello();
Sub\hi::say(); //App\Sub\hi::say()
echo Sub\text . "<br>"; //App\Sub\text

//Fully qualified name (Tất cả bắt đầu bằng \)
\App\hello(); // App\hello()
\App\hi::say(); // App\hi::say()
echo \App\text . "<br>"; //App\text