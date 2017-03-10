<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   <?php
    $file = "example.txt";
    
    if($handle = fopen($file, 'w')) { //w for write
        echo 'file opened';
        fwrite($handle, 'Woot writing the file!');
    
    } else {
        echo 'could not open file';
    }
    fclose($handle);
    ?>
    
</body>
</html>
