<?php
//NOTE: needed to change $offset = -1 to %offset = 0
//  In simple_html_dom.php line 70, due to PHP "support for negative offsets)
//  https://github.com/sunra/php-simple-html-dom-parser/issues/41
//Alternative approach:
//  $html = str_get_html(file_get_contents('http://www.google.com'));
//echo out pure html: echo htmlspecialchars($html);

require('simple_html_dom.php');
$urls = array();
$charAll= array();
$c = ",";
$t = "<tab>";

array_push($urls, 'https://swgoh.gg/u/darkness39/collection/');
array_push($urls, 'https://swgoh.gg/u/bigjohnnyk/collection/');

foreach ($urls as $url) {

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