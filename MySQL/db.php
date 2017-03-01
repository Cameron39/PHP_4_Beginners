<?php
     $connection = mysqli_connect('localhost', 'root', '', 'loginapp'); //machine, login user, password, database

    if(!$connection){
        die('connection DENIED<br>');
    }

?>