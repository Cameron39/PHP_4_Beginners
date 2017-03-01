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

function updateTable() {
    global $connection;
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    
    $query = "UPDATE USERS SET USERNAME='$username', PASSWORD='$password' WHERE ID=$id";
    
    $result = mysqli_query($connection, $query);
    if(!$result) {die("QUERY FAILED" . mysqli_error($connection));}
}

function deleteRow(){
    global $connection;
    
    $id = $_POST['id'];
    
    $query = "DELETE FROM USERS WHERE ID=$id";
    $result = mysqli_query($connection, $query);
    if(!$result) {die("QUERY FAILED" . mysqli_error($connection));}
    
}

?>