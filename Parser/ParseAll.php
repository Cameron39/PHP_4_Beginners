<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Complete Parser</title>
    </head>
    <body>
    <?php
        include "getGuild.php";
        include "charsparser.php";
        include "shipsparser.php";
        
        echo '<table>';
        echo '<tr>';
        echo '<th>User</th>';
        echo '<th>Name</th>';
        echo '<th>Stars</th>';
        echo '<th>Level</th>';
        echo '<th>Gear</th>';
        echo '<tr>';
        
        $urls = getUserURLS();
        
        getShipData($urls);
        getCharData($urls);
        
        echo '</table>'
        
    ?>
    
    </body>
</html>