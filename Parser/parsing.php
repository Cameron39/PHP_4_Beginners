<?php
//NOTE: needed to change $offset = -1 to %offset = 0
//  In simple_html_dom.php line 70, due to PHP "support for negative offsets)
//  https://github.com/sunra/php-simple-html-dom-parser/issues/41
//Alternative approach:
//  $html = str_get_html(file_get_contents('http://www.google.com'));
//echo out pure html: echo htmlspecialchars($html);
include "getGuild.php";

$urls = array();
$charAll = array();
$master = array();
$c = ",";
$t = "<tab>";
$q = "','";
$servername = 'localhost';
$username = 'root';
$password = 'droid4swgoh';

$urls = getUserUrls();

//$urls['darkness39'] = '/u/darkness39/'; //For testing 
//$urls['bigjohnnyk'] = '/u/bigjohnnyk/';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo 'DB is okay<br>';
}

$sql = 'CREATE DATABASE IF NOT EXISTS SW';
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error);
}

mysqli_select_db($conn,"SW");

$sql = 'DROP TABLE IF EXISTS TOONS';
if ($conn->query($sql) === TRUE) {
    echo 'Table Dropped<br>';
} else {
    die("Error truncating table: " . $conn->error);
}

$sql = 'CREATE TABLE TOONS (
        id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(id),
        USER    VARCHAR(100) NOT NULL,
        TOON    VARCHAR(100) NOT NULL,
        STAR    INT,
        VALID   CHAR(1),
        LEVEL   INT,
        GEAR    CHAR(5))';
if ($conn->query($sql) === TRUE) {
    echo "Table Created<br>";
} else {
    die("Error creating table: " . $conn->error);
}

foreach ($urls as $user => $profile) {

    $url = 'https://swgoh.gg' . $profile . 'collection/';
    //echo $url . '<br>';
    sleep(0.1);
    $html = file_get_html($url);

    $items = $html->find('div[class=col-xs-6 col-sm-3 col-md-3 col-lg-2]');

    foreach ($items as $item){
        $name = getName($item->children(0)->children(0)->children(0));//->children(0));
        $level = getLevel($item->children(0)->children(0)->children(0));
        $gear = getGear($item->children(0)->children(0)->children(0));//->children(10));
        $stars = getStars($item->children(0)->children(0)->children(0));
        if ($stars > 3) {
            $valid = 'X';
        } else {
            $valid = 'N';
        }
        
        $sql = "INSERT INTO TOONS (USER, TOON, STAR, VALID, LEVEL, GEAR) " .
            "VALUES ('" . $user . $q . $name . $q . $stars . $q . $valid . 
            $q . $level . $q . $gear . "')";
        //echo $sql . '<br>';
        
        if ($conn->query($sql) === TRUE) {
            //echo $name . $c . '<br>';
        } else {
            die ('Error Inserting: ' . $conn->error . '<br>SQL: ' . $sql);
        }
        //echo $name . $c . $stars . $c . $level . $c . $gear . $c . $valid . "<br>";
    }

    echo 'User: ' . $user . ' -> done<br>';
    ob_flush();
    flush();
    //sleep(1);
    //echo "<br><br>";
}

echo '<br>DONE!';

mysqli_close($conn);

function getName($html){

    //echo htmlspecialchars($html) . "<br>";
    if (($html->find('img[class=char-portrait-full-img]'))) {
        $tname = $html->children(0)->alt;
        //echo htmlspecialchars($html->children(0)->alt);
    }
    elseif (($html->find('img[class=char-portrait-img]'))) {
        $tname = $html->children(0)->children(0)->alt;
        //echo htmlspecialchars($html->children(0)->children(0)->alt);
    } else {
        $tname = 'NA';
    }
    //echo htmlspecialchars($html);
    //$name = str_replace('&quot;',' ', $name); //seems to slow it down?
    //$name = str_replace('&#39;',' ', $name);
    return $tname;
}

function getLevel($html){
    $level = 0;
    if ($html !== NULL && ($html->find('div[class=char-portrait-full-level]'))) {
        $level = $html->children(9)->plaintext;
    }
    return $level;
}

function getGear($html){
    $gear = 0;
    if ($html !== NULL && ($html->find('div[class=char-portrait-full-gear-level]'))) {
        $gear = $html->children(10)->plaintext;
        //echo htmlspecialchars($html->children(10)->plaintext) . "<br>";
    }
    
    switch ($gear) {
        case 'I' : 
            $gear = '1'; 
            break;
        case 'II' :
            $gear = '2';
            break;
        case 'III' :
            $gear = '3';
            break;
        case 'IV' :
            $gear = '4';
            break;
        case 'V' :
            $gear = '5';
            break;
        case 'VI' :
            $gear = '6';
            break;
        case 'VII' :
            $gear = '7';
            break;
        case 'VIII' :
            $gear = '8';
            break;
        case 'IX' :
            $gear = '9';
            break;
        case 'X' :
            $gear = '10';
            break;
        case 'XI' :
            $gear = '11';
            break;
        case 'XI' :
            $gear = '12';
            break;
        case 'XII' :
            $gear = '13';
            break;
        case 'XIII' :
            $gear = '14';
            break;
        default :
            $gear = '0';        
    }
    return $gear;
}

function getStars($html){
    $stars = 0;
    
    if (strlen((string)$html->children(2)) == 30) {$stars++;}
    if (strlen((string)$html->children(3)) == 30) {$stars++;}
    if (strlen((string)$html->children(4)) == 30) {$stars++;}
    if (strlen((string)$html->children(5)) == 30) {$stars++;}
    if (strlen((string)$html->children(6)) == 30) {$stars++;}
    if (strlen((string)$html->children(7)) == 30) {$stars++;}
    if (strlen((string)$html->children(8)) == 30) {$stars++;}
    
    return $stars;
}

?>