<?php

//$_COOKIE; //Super global cookie variable

$name = "TheName";
$value = "Billy";
$expiration = time() + (60*60*24*7); //add one week to current time 

setcookie($name,$value,$expiration);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies Example</title>
</head>
<body>
    
</body>
</html>
