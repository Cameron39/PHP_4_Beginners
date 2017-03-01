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

?>