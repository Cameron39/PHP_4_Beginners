<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   <?php
    $file = "example.txt";
    
    //writing from file
    if($handle = fopen($file, 'w')) { //w for write
        fwrite($handle, 'Woot writing the file!');
    
    } else {
        echo 'could not write file';
    }
    fclose($handle);
    
    //Reading from file
    if($handle = fopen($file, 'r')) { //r for write
        $content = fread($handle, 22); //second var is bytes, # of char
        //use filesize($file) instead of number to get whole file
        echo $content;
    } else {
        echo 'could not read file';
    }
    fclose($handle);
    
    
    
    ?>
    
</body>
</html>
