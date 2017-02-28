<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Processing</title>
</head>
<body>
   
   <?php
    $validuser = array('Mike', 'Chris', 'Cam', 'Bill', 'Matt', 'Shaq');
        
    if(isset($_POST['submit'])) { //must match name from submit (which is submit) 
        echo 'we got something!<br>';
        $user = $_POST['username'];
        $psw = $_POST['password'];
        
        if(strlen($user) < 4) {
            echo 'username must be longer than 5<br>';
        } elseif(strlen($user) > 10 ) {
            echo 'username cannot be longer than 10<br>';
        }
        
        if(!in_array($user, $validuser)){
            echo 'Invalid user! You do not have access!<br>';
        } else {
            echo 'Welcome ' . $user . '<br>';
        }
        
        echo 'username: ' . $user . '<br>';
        echo 'password: ' . $psw . '<br>';
    }
    
    
    ?>
    
</body>
</html>
