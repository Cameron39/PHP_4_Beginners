<?php
    //$_POST //will pick up user data input from forms, as is defined
            //is a super global variable, as an array
        
    if(isset($_POST['submit'])) { //must match name from submit (which is submit) 
        echo 'we got something!<br>';
        $user = $_POST['username'];
        $psw = $_POST['password'];
        echo 'username: ' . $user . '<br>';
        echo 'password: ' . $psw . '<br>';
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   
    
    <form action="form.php" method="post"> <!-- page that collects the data-->
        <input type="text" name='username' placeholder="Enter user Name">
        <input type="password" name='password' placeholder="Enter Password">
        <br>
        <input type="submit" name="submit">
    </form>
    
    
    
</body>
</html>
