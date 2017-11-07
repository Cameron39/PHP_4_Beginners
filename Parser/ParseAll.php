<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Complete Parser</title>
</head>

<body>
    <?php
        //NOTE: needed to change $offset = -1 to %offset = 0
        //  In simple_html_dom.php line 70, due to PHP "support for negative offsets)
        //  https://github.com/sunra/php-simple-html-dom-parser/issues/41
        //Alternative approach:
        //  $html = str_get_html(file_get_contents('http://www.google.com'));
        //echo out pure html: echo htmlspecialchars($html);
        //include "getGuild.php";
    
        function getAllData($urls) {
        ini_set('max_execution_time', 300); //5 minutes.
            
        $d = '<td>';
        $e = '</td>';
        $count = 1;
        $ttl_cnt= 0;
        $ttl_cnt = count($urls);
            
        foreach ($urls as $user => $profile) {

            //Characters
            $url = 'https://swgoh.gg' . $profile . 'collection/';
            //sleep(0.1);
            $html = file_get_html($url);
            $items = $html->find('div[class=col-xs-6 col-sm-3 col-md-3 col-lg-2]');

            foreach ($items as $item){
                $charName = getCharName($item->children(0)->children(0)->children(0));
                $charLevel = getCharLevel($item->children(0)->children(0)->children(0));
                if ($charLevel > 0) {
                    $charGear = getCharGear($item->children(0)->children(0)->children(0));
                    $charStars = getCharStars($item->children(0)->children(0)->children(0));
                } else {
                    $charGear = '0';
                    $charStars = '0';
                }
                echo '<tr>';
                echo $d . $user . $e;
                echo $d . $charName . $e;
                echo $d . $charStars . $e;
                echo $d . $charLevel . $e;
                echo $d . $charGear . $e;
                echo '</tr>';      
            }
            
            //Ships
            $url = 'https://swgoh.gg' . $profile . 'ships/';
            $html = file_get_html($url);
            $items = $html->find('div[class=col-sm-6 col-md-6 col-lg-4]');
            
           foreach ($items as $item){
               $shipName = getShipName($item->children(0)->children(0)->children(0)->children(0)->children(0));//->children(1)->children(1));
               $shipLevel = getShipLevel($item->children(0)->children(0)->children(0)->children(0)->children(0)->children(1));
               if ($shipLevel > 0) {
                   $shipStars = getShipStars($item->children(0)->children(0)->children(0)->children(0)->children(0)->children(0));
               } else {
                   $shipLevel = 0;
               }
               echo '<tr>';
               echo $d . $user . $e;
               echo $d . $shipName . $e;
               echo $d . $shipStars . $e;
               echo $d . $shipLevel . $e;
               echo '</tr>';
           }

            ob_flush();
            flush();
            $count++;
        }

    }
        function getCharName($html){
            if (($html->find('img[class=char-portrait-full-img]'))) {
                $tname = $html->children(0)->alt;
            }
            elseif (($html->find('img[class=char-portrait-img]'))) {
                $tname = $html->children(0)->children(0)->alt;
            } else {
                $tname = 'NA';
            }
            return cleanNames($tname);
        }

        function getCharLevel($html){
            $level = 0;
            if ($html !== NULL && ($html->find('div[class=char-portrait-full-level]'))) {
                $level = $html->children(9)->plaintext;
            }
            return $level;
        }

        function getCharGear($html){
            $gear = 0;
            if ($html !== NULL && ($html->find('div[class=char-portrait-full-gear-level]'))) {
                $gear = $html->children(10)->plaintext;
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

        function getCharStars($html){
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
    
        function getShipName($html){
            $tname = 'NA';
            if (($html->find('img[class=ship-portrait-full-frame-img]'))) {
                $tname = $html->children(1)->children(1)->children(0)->alt;
            }
            elseif (($html->find('img[class=ship-portrait-frame-img]'))) {
                $tname = $html->children(0)->children(1)->children(0)->alt;
            }
            return cleanNames($tname);
        }

        function getShipLevel($html){
            $level = 0;
            if ($html !== NULL && ($html->find('div[class=ship-portrait-full-frame-level]'))) {
                $level = $html->children(2)->plaintext;
            }
            return $level;
        }

        function getShipStars($html){
            $stars = 0;
            if (strlen((string)$html->children(0)) == 43) {$stars++;}
            if (strlen((string)$html->children(1)) == 43) {$stars++;}
            if (strlen((string)$html->children(2)) == 43) {$stars++;}
            if (strlen((string)$html->children(3)) == 43) {$stars++;}
            if (strlen((string)$html->children(4)) == 43) {$stars++;}
            if (strlen((string)$html->children(5)) == 43) {$stars++;}
            if (strlen((string)$html->children(6)) == 43) {$stars++;}

            return $stars;
        }
        
        function cleanNames($name){
            $badChar1 = array(chr(145), chr(146), chr(147), chr(148),'&quot;');
            $badChar2 = array('&#39;', ' s ');
            if ($name == 'Chirrut Îmwe') {
                $name = 'Chirrut Imwe';
            } 
            $name = str_replace($badChar1,'',$name);
            $name = str_replace($badChar2,' ',$name);
            return $name;
        }

        ?>
</body>

</html>