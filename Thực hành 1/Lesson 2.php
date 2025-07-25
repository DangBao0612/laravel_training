<?php
$s = "Hello World!";//Khởi tạo biến hello world
echo $s; 

$t = date("H"); //24h format
if ($t <= 10){
    echo "Good morning!";
} elseif ($t <=20){
    echo "Good day!";
} else {
    echo "Good night!";
}

$favcolor = "red";

switch ($favcolor) {
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}

$colors = ["red", "green", "blue"];

foreach ($colors as $color) { // Duyệt qua dnah sách các phần tử trong mảng
    echo "Color: $color <br>";
}

$fruits = ["Apple", "Banana", "Orange"]; // Indexed array: Mỗi phần tử được gán dữ liệu, thứ tự từ 0,1,2...

echo $fruits[0];  // Apple
echo "<br>";
echo $fruits[1];  // Banana

$ages = [ // Associative array: Mỗi phần tử chứa dữ liệu dạng chuỗi
    "Beo" => 20,
    "Lan" => 22,
    "Minh" => 19
];

echo "Beo is " . $ages["Beo"] . " years old.";  // Beo is 20 years old.

$students = [ // Multidimensional array: Mỗi phần tử là một mảng con
    ["name" => "Beo",  "score" => 9],
    ["name" => "Lan",  "score" => 8],
    ["name" => "Minh", "score" => 10]
];

echo $students[0]["name"];   // Beo
echo "<br>";
echo $students[2]["score"];  // 10
