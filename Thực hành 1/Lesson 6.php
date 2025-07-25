<?php
class Pokemon{ // thực hành magic method
    private $data =[]; // Khai biến data là một mảng rỗng động để lưu trữ các thuộc tính mà user đặt tùy ý
    public $name, $type, $region;

    public function _set($name,$value){ //$name : Tên thuộc tính; $value: Giá trị thuộc tính. VD: name->Type, Region,...; value->Fire, Kanto,...
        $this->data[$name] = $value; //định nghĩa cho mảng rỗng động trên, để người dùng có thể set data
    }

 public function __get($name) {
        return $this->data[$name] ?? "Không tồn tại!"; //định nghĩa cho mảng rỗng động, để người dùng có thể xuất data theo dạng this->
    }
}
$poke1 = new Pokemon();
$poke1->name = "Pikachu";
$poke1->type = "Electric";
$poke1->region = "Kanto";
echo "Pokemon: ".$poke1->name."<br>";
echo "Type: ".$poke1->type."<br>";
echo "Region: ".$poke1->region."<br>";

interface Flyable{ //Với động vật. Có 2 interface Flyable và makingNest. Class cha Animal cos 2 thuộc tính eat và move. Thì class con Bird có thể implement cả 2 interfaces, nhưng chỉ có thể extend 1 class cha, và inherit cả 2 thuộc tính của class cha đấy.
    public function fly();
} 

interface NestBuilder{
    public function makeANest();
}

class Animal{
    public function Eat(){
        echo "Đang ăn...<br>";
    }

    public function Move(){
        echo "Đang di chuyển...<br>";
    }
}

class Bird extends Animal implements Flyable, NestBuilder{
    public function fly(){
        echo "Bay lên!<br>";
    }

    Public function makeANest()
    {
        echo "Làm tổ!<br>";
    }
}

$chim = new Bird();
$chim->eat(); //Inherit
$chim->Move();//Inherit
$chim->fly();// Implements
$chim->makeANest();// Implements

abstract class Dongvat {
    protected $name;
    public function __construct($name){ //khoi tao
        $this->name =$name;
    }

    public function eat(){
        echo $this->name . " dang an...<br>";
    }

    abstract protected function move(); //Hàm trừu tượng, không có body
}

class Cho extends Dongvat {
    public function move(){ //Ghi đè hàm trừu tượng
        echo $this->name . " Di bang 4 chan<br>";
    }
}

class Chim extends Dongvat {
    public function move(){
        echo $this->name . " Bay bang canh<br>";
    }
}

$cho = new Cho("Cho");
$chim = new Chim("Chim");
$cho->eat();
$cho->move();
$chim->eat();
$chim->move();