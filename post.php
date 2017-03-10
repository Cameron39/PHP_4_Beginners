<?php
echo $_POST["name"]; //first time will error out as no value
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POST Example</title>
</head>
<body>
   
<form action="post.php" method="post">
    <input type="text" name='name'>
    <input type="submit">
</form>
</body>
</html>
