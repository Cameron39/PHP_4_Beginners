<?php

class Car {
    var $wheels;            //var is public
    protected $hood = 1;    //must use method to access/modify
    private $engine = 1;    //invisible outside the class
    var $doors = 4;
    public $mph = 0;
    
    function __construct(){
        $this->wheels = 4;
    }
    
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
