<?php
//NOTE: needed to change $offset = -1 to %offset = 0
//  In simple_html_dom.php line 70, due to PHP "support for negative offsets)
//  https://github.com/sunra/php-simple-html-dom-parser/issues/41
//Alternative approach:
//  $html = str_get_html(file_get_contents('http://www.google.com'));
//echo out pure html: echo htmlspecialchars($html);
include "getGuild.php";
include "char.php";

//require('simple_html_dom.php');
$urls = array();
$charAll = array();
$master = array();
$c = ",";
$t = "<tab>";
$servername = 'localhost';
$username = 'root';
$password = 'droid4swgoh';

$urls = getUserUrls();

//array_push($urls, 'https://swgoh.gg/u/darkness39/collection/');
//array_push($urls, 'https://swgoh.gg/u/bigjohnnyk/collection/');
/*
Thoghts: user -> characters[char]
Database?
-user | char | star | level | gear?
-need to create Database, create table;
*/

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo 'DB is okay<br>';
}

$sql = "CREATE DATABASE IF NOT EXISTS SW";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error);
}

mysqli_select_db($conn,"SW");

$sql = 'CREATE TABLE IF NOT EXISTS toons (
        id INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(id),
        USER    char(100) NOT NULL,
        TOON    char(100) NOT NULL,
        STAR    INT,
        LEVEL   INT,
        GEAR    char(5))';
if ($conn->query($sql) === TRUE) {
    echo "Table Created<br>";
} else {
    die("Error creating table: " . $conn->error);
}



// ...some PHP code for database "test"...

mysqli_close($conn);

exit();
foreach ($urls as $user => $profile) {

    $url = 'https://swgoh.gg' . $profile . 'collection/';
    //echo $url . '<br>';

    $html = file_get_html($url);

    $items = $html->find('div[class=col-xs-6 col-sm-3 col-md-3 col-lg-2]');

    foreach ($items as $item){
        $name = getName($item->children(0)->children(0)->children(0));//->children(0));
        $level = getLevel($item->children(0)->children(0)->children(0));
        $gear = getGear($item->children(0)->children(0)->children(0));//->children(10));
        $stars = getStars($item->children(0)->children(0)->children(0));

        echo $name . $c . $stars . $c . $level . $c . $gear . "<br>";
        //echo $name . $t . $stars . "<br>";
    }
    //echo htmlspecialchars($items[0]->children(0)->children(0)->children(0));
    //echo "<br><br>";

    echo "<br><br>";
}

function getName($html){
    $name = "NA";
    //echo htmlspecialchars($html) . "<br>";
    if (($html->find('img[class=char-portrait-full-img]'))) {
        $name = $html->children(0)->alt;
        //echo htmlspecialchars($html->children(0)->alt);
    }
    elseif (($html->find('img[class=char-portrait-img]'))) {
        $name = $html->children(0)->children(0)->alt;
        //echo htmlspecialchars($html->children(0)->children(0)->alt);
    }
    //echo htmlspecialchars($html);
    return $name;
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