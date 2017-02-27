<?php
    //$_POST //will pick up user data input from forms, as is defined
            //is a super global variable, as an array
        
    if(isset($_POST['submit'])) { //must match name from submit (which is submit) 
        echo 'we got something!';
        //echo 'username' . $_POST['name'] . '<br>';
        //echo 'password' . $_POST[1] . '<br>';
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
        <input type="text" placeholder="Enter user Name" name='name'>
        <input type="password" placeholder="Enter Password" name='password'>
        <br>
        <input type="submit" name="submit">
    </form>
    
    
    
</body>
</html>
