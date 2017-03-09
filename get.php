
<?php

$_GET;

print_r($_GET);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GET Example</title>
</head>
<body>
  <br></br>
   <a href="get.php?id=200&user=WHAT">Click Here for 200</a>
   <?php
    
    $id = 10;
    
    ?>
    
    <a href="get.php?id=<?php echo $id;?>">Click here for 10</a>
    
</body>
</html>
