<?php
class MyFirstClass
{
    public $a = "Hello<br>";
    public function displaya() {
        echo $this->a;
    }
}

$obj = new MyFirstClass();
$obj->displaya();

class Human{
    public $name;
    public function __construct($name){
        $this->name = $name;
        echo "Hello, $this->name<br>";
}
    public function _destruct(){
        echo "$this->name đã rời khỏi đây !<br>";
    }
}
$human = new Human ("Beo"); 

class Pokemon { 
    private $type;
    private $region;
    public function __construct(){}
    public function sayHello()  {
        return "Hello trainer! <br>";
    }

    public function getType() {
        return $this->type;
    }

    public function getRegion(){
        return $this->region;
    }

    public function setType($type){
        $this->type = $type;
    }
    public function setRegion($region){
        $this->region = $region;
    }
}

$poke1 = new Pokemon();
$poke1->setType("Fire");
 $poke1->setRegion("Kanto");

echo $poke1->sayHello();
echo "Type: ".$poke1->getType() . "<br>";
echo "Region: ".$poke1->getRegion() . "<br>" ;