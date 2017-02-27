<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   <?php
    //variables declared outside a function cannot be modified inside UNLESS GLOBAL
    //global variable, can be modified perminently inside a function now
    global $myVar; 
    
    //constant variable. First value is the name, second is the value
    define("name", 1000);
    
    ?>
    
</body>
</html>
