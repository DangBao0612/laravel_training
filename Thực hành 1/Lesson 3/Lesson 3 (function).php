<?php
function sayHello(){ //Function
    echo "Hello World !<br>";
}
sayHello();

function clubsHistory($name, $year){ //Function Argument
    echo "Club: $name. Established in $year<br>";
}

for ($x = 0; $x<2; $x++){
    clubsHistory("Chelsea","1905");
}

function setScore ($score=66) { // default value
    echo "Highest score is: $score<br>";
}

setScore(55);
setScore(0);
setScore();

function sumXY($x,$y){ //function returning value
    $z = $x + $y;
    return $z;
}
echo sumXY("3","5");
?>