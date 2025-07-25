<?php
class Animal {
    protected $sound; //Dong goi
    public function makeASound($sound){
        echo "Make a sound: ".$sound."<br>";
    }
    public function printSth(){
        echo "This is an animal !<br>";
    }
}

class Dog extends Animal { //Ke thua
    public function makeASound($sound){
        echo "Woof ". $sound."<br>";
    }
}

$Animal = new Animal();
$Dog = new Dog();
$Animal->makeASound("sound");
$Animal->printSth();
$Dog->makeASound("woof");
$Dog->printSth();