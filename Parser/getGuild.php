<?php
//https://swgoh.gg/u/darkness39/collection/
//https://swgoh.gg/oneBigJohnnyK/collection/
require('simple_html_dom.php');

//$users = getUserUrls();

//print_r($users);

function getUserUrls(){

    $url = 'https://swgoh.gg/g/3532/the-ones-r2-destroyers/';

    $html = file_get_html($url);

    $items = $html->find('tr');
    $users = array();

    //echo htmlspecialchars($items[0]->children(0)->plaintext);

        foreach($items as $item){
            if ($item->children(0)->plaintext == 'Name'){
                continue;
            }
            //echo htmlspecialchars($item->children(0)->children(0)->href) . "<br>";
            array_push($users, 'https://swgoh.gg' . $item->children(0)->children(0)->href . 'collection/');
        }
    return $users;
}

?>