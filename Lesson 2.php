<?php
$s = "hello<br>"; //khai bien
echo $s;

$t = date("H"); //IF ELSE
if ($t < "20") {
    echo "Have a good day!";
} else {
    echo "Have a good night !";
}

$t = date("J"); //IF ELSEIF ELSE
if ($t < "10"){
    echo "Have a good morning";
} elseif ($t < "20") {
    echo "Have a good day";
} else {
    echo "Have a good night";
}

$favcolor = "red"; //SWITCH
switch($favcolor){
    case "red":
        echo "Your favorite color is red!";
        break;
    case "blue":
        echo "Your favorite colour is blue!";
        break;
    case "green":    
        echo "Your favorite color is green!";
        break;
    default: // Tat ca cac dieu kien deu ko thoa
        echo "Your favorite color is neither red, blue nor green";     
}

$colors = array("red" , "green", "blue", "orange"); //foreach loop
foreach ($colors as $value){
    echo "$value <br>";
}

$clubs = [" Chelsea" , " Arsenal" , " MU"]; //Indexed Array
echo "<br>I like " .  $clubs[0];

$cups = array("Chelsea"=>"2","MU"=>3,"Arsenal"=>0); //Associative Array
echo "<br>How many cups did Arsenal win ?<br>";
echo "The answer is ".$cups['Arsenal'];

$jersey = [ //Multidimensional Array
    ["Chelsea",23,44],
    ["MU",22,45],
    ["Liverpol",53,23],
    ["Mci",22,55]
];
echo $jersey[0][0].": In stock: ".$jersey[0][1].", sold: ".$jersey[0][2]."<br>";
echo $jersey[1][0].": In stock: ".$jersey[1][1].", sold: ".$jersey[1][2]."<br>";
echo $jersey[2][0].": In stock: ".$jersey[2][1].", sold: ".$jersey[2][2]."<br>";
echo $jersey[3][0].": In stock: ".$jersey[3][1].", sold: ".$jersey[3][2]."<br>";

?>