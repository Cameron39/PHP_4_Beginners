<?php

class Car {
    var $wheels = 4;
    var $hoo = 1;
    var $engine = 1;
    var $doors = 4;
    var $mph = 0;
    
    function MoveWheels() {
        echo "Wheels Moved";  
    }
    
    function upMph(){
        $this->mph = 10;
    }
    
}

/*
if(class_exists("Car")) {
    echo "Exists";
} else {
    echo "DNE";
}

if(method_exists("Car", "MoveWheels")) {
    echo "Exists";
} else {
    echo "DNE";
}
*/

$focus = new Car();

$focus->MoveWheels();
$focus->wheels = 8;
echo "<br>wheels: " . $focus->wheels;
echo "<br> mph: " . $focus->mph;
$focus->upMph();
echo "<br> mph: " . $focus->mph;
?>
