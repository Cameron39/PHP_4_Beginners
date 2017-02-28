<?php

    $connection = mysqli_connect('localhost', 'root', '', 'loginapp'); //machine, login user, password, database

    if($connection){
        echo 'connection established<br>';
    } else {
        die('connection DENIED<br>');
    }

    $query = "SELECT * FROM users ";

    $result = mysqli_query($connection, $query); //use the connection to execute the query
    if(!$result){
        die('Select Query Failure' . mysqli_error());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MySQL Login with bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
      <div class="col-md-6"> <!--md for medium, sm for small, xl for xtra large -->
         
            <?php
            while($row = mysqli_fetch_assoc($result)){ //or mysqli_fetch_row
            ?>
               <pre>
                <?php print_r($row); ?>
                </pre>
            <?php    
            }
            ?>
          
      </div>
  </div>
</body>
</html>
