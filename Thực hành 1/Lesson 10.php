<?php
/* Trait là một "tộc hệ" chứa các biến, thuộc tính và hàm để các class con "use" nhiều lần, 
nhưng bản thân nó khong phải là một object cụ thể (không thể new Trait). Đây là khác biệt lớn nhất giữa Trait và Class */

trait HelloWorld {
    public function Hello (){
            echo "Hello world!";
}
}

class TheWorldIsNotEnough {
    use HelloWorld;
    public function Hello () {
        echo "Hello UNIVERSE !"; // Ghi đè lên function Hello của trait
    }
}

$i = new TheWorldIsNotEnough;
$i -> Hello(); // Hello UNIRVERSE

class Base {
    public function sayHello(){
        echo "Hello";
    }
}

trait SayWorld {
    public function sayHello (){
        parent::sayHello(); // Gọi hàm gốc từ lớp cha
        echo " World!"; // Ghi đè method sayHello() của lớp Base
    }
}

class MyHelloWorld extends Base {
    use SayWorld; // Không xóa logic cũ đã tạo ở class base, gọi lại sayHello() bằng parent::, để nó chạy trước và ghi đè thêm "World"
} // Output: Hello World!

trait Hello {
    public function sayHello2 (){
            echo "Hello";
    }
}

trait World {
    public function sayWorld(){
        echo " World";
    }
}

class MyHelloWorld2 {
    use Hello,World; // Dùng cả 2 trait
    public function sayHelloWorld(){
         echo "!<br>"; // Ghi đè
}
    }

$o = new MyHelloWorld2;
$o -> sayHello2();
$o-> sayWorld();
$o -> sayHelloWorld(); // Hello World!

trait A {
    public function smallTalk() {
        echo "a";
    }

    public function bigTalk() {
        echo "A";
    }
}

trait B {
    public function smallTalk() {
        echo "b";
    }

    public function bigTalk() {
        echo "B";
    }
}

class Talk {
    use A, B {
        B::smallTalk insteadof A;        // dùng B::smallTalk thay vì A::smallTalk
        A::bigTalk insteadof B;          // dùng A::bigTalk thay vì B::bigTalk
        B::bigTalk as Talk;              // tạo bí danh "Talk" cho B::bigTalk
    }
}

$obj = new Talk();
$obj->smallTalk(); // b
$obj->bigTalk();   // A
$obj->Talk();      // B
