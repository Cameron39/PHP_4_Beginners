<?php 
include "db.php";


function showAllData() {
    global $connection;
    
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query); //use the connection to execute the query
    if(!$result){
        die('Select Query Failure' . mysqli_error());
    }
    
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function readRows() {
    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($result)){ //or mysqli_fetch_row
        print_r($row);   
    }
}

function createRow() {
    global $connection;
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $connection = mysqli_connect('localhost', 'root', '', 'loginapp'); //machine, login user, password, database
    
    /*if($connection){
        echo 'connection established<br>';
    } else {
        die('connection DENIED<br>');
    }*/
    
    $query = "INSERT INTO USERS(USERNAME, PASSWORD) ";
    $query .= "VALUES ('$username', '$password')"; //quotes needed to show they are strings, good idea to use double quotes!
    
    $result = mysqli_query($connection, $query); //use the connection to execute the query
    if(!$result){
        die('Insert Query Failure' . mysqli_error());
    } else {
        echo 'Record Created<br>';
    }
}

function updateTable() {
    global $connection;
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    
    $query = "UPDATE USERS SET USERNAME='$username', PASSWORD='$password' WHERE ID=$id";
    
    $result = mysqli_query($connection, $query);
    if(!$result) {die("QUERY FAILED" . mysqli_error($connection));}
    else {echo 'Record Updated<br>';}
}

function deleteRow(){
    global $connection;
    
    $id = $_POST['id'];
    
    $query = "DELETE FROM USERS WHERE ID=$id";
    $result = mysqli_query($connection, $query);
    if(!$result) {die("QUERY FAILED" . mysqli_error($connection));}
    else {echo 'Record Updated<br>';}
    
}

?>