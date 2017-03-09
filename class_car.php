<?php

class Car {
    
    function MoveWheels() {
        echo "Wheels Moved";
        
    }
    
}

/*
if(class_exists("Car")) {
    echo "Exists";
} else {
    echo "DNE";
}
*/
if(method_exists("Car", "MoveWheels")) {
    echo "Exists";
} else {
    echo "DNE";
}


?>
