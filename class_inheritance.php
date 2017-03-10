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

class Plane extends Car {
    var $wings = 2;
}

$focus = new Car();
$jet = new Plane();

$focus->MoveWheels();
$focus->wheels = 8;
echo "<br>wheels: " . $focus->wheels;
echo "<br> mph: " . $focus->mph;
$focus->upMph();
echo "<br> mph: " . $focus->mph;

$jet->wheels = 2;
echo "<br> jet wheels:" . $jet->wheels;
?>
