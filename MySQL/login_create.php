<?php include "db.php"

if(isset($_POST['submit'])) {
    //echo 'got it';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    /*
    if($username && $password){
        echo 'Username: ' . $username . '<br>';
        echo 'Password: ' . $password . '<br>';
    } else {
        echo 'no data<br>';
    }
    */
    $connection = mysqli_connect('localhost', 'root', '', 'loginapp'); //machine, login user, password, database
    
    
    
    if($connection){
        echo 'connection established<br>';
    } else {
        die('connection DENIED<br>');
    }
    
    $query = "INSERT INTO USERS(USERNAME, PASSWORD) ";
    $query .= "VALUES ('$username', '$password')"; //quotes needed to show they are strings, good idea to use double quotes!
    
    $result = mysqli_query($connection, $query); //use the connection to execute the query
    if(!$result){
        die('Insert Query Failure' . mysqli_error());
    }
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
      <div class="col-sm-6">
          <form action="login_create.php" method="post">
              <div class="form-group">
                 <label for="username">Username</label>
                  <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                 <label for="password">Password</label>
                  <input type="password" name="password" class="form-control">
              </div>
              <input class="btn btn-primary" type="submit" name="submit" value="Submit">
          </form>
      </div>
  </div>
</body>
</html>
