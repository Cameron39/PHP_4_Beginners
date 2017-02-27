<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <?php
    //Basic Function
    function theFunc(){
        echo 'testing<br>';
    }
    theFunc();
    
    //Example of Params
    function addUs($num1, $num2){
        echo $num1 + $num2 . '<br>';
    }
    addUs(4,29);
    
    //Example of Return
    function addTwo($num){
        return $num + 2 . '<br>';
    }
    echo '2 becomes ' . addTwo(2);
    
    ?>

</body>

</html>
