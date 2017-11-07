<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Ships Parser</title>
    </head>
    <body>

        <?php

        //include "getGuild.php";
        //getShipData();
        
        function getShipData($urls) { 
        ini_set('max_execution_time', 300); //5 minutes.
            
        $c = ",";
        $t = "&emsp;";
        $q = "','";
        $d = '<td>';
        $e = '</td>';
        $count = 1;
        $ttl_cnt=0;

        //$urls = getUserUrls();

        $ttl_cnt = count($urls);
        
        //$url = 'https://swgoh.gg/u/darkness39/ships/';
        //$html = file_get_html($url);
        //$items = $html->find('li[class=media list-group-item p-a collection-char-list]');
        //echo $items[0]->children(0);
        //echo $items[0];
        
        foreach ($urls as $user => $profile) {

            $url = 'https://swgoh.gg' . $profile . 'ships/';
            //echo $url . '<br>';
            //$url = $url = 'https://swgoh.gg/u/darkness39/ships/';
            //$user = 'Demoon';
            sleep(0.1);
            $html = file_get_html($url);

            //$Mitems = $html->find('li[class=media list-group-item p-a collection-char-list]');
            //$items = $Mitems[0]->children(0);
            $items = $html->find('div[class=col-sm-6 col-md-6 col-lg-4]');
            //echo htmlspecialchars($items);

            foreach ($items as $item){
                //echo htmlspecialchars($item);
                $shipName = getShipName($item->children(0)->children(0)->children(0)->children(0)->children(0));//->children(1)->children(1));
                $shipLevel = getShipLevel($item->children(0)->children(0)->children(0)->children(0)->children(0)->children(1));
                $shipStars = getShipStars($item->children(0)->children(0)->children(0)->children(0)->children(0)->children(0));
                //echo $name . $t . $stars . $t . $level . $t . $valid . "<br>";
                echo '<tr>';
                echo $d . $user . $e;
                echo $d . $shipName . $e;
                echo $d . $shipStars . $e;
                echo $d . $shipLevel . $e;
                echo '</tr>';
                //break;
            }

            //echo '(' . $count . '/'. $ttl_cnt . ') User: ' . $user . ' -> done<br>';
            ob_flush();
            flush();
            $count++;
            //sleep(1);
            //echo "<br><br>";
        }
    }

        function getShipName($html){

            //echo htmlspecialchars($html) . "<br><br>";
            $tname = 'NA';
            if (($html->find('img[class=ship-portrait-full-frame-img]'))) {
                //echo htmlspecialchars($html->children(1)->children(1)->children(0)->alt) . '<br><br>';
                $tname = $html->children(1)->children(1)->children(0)->alt;
                //echo 'name: ' . $tname;
            }
            elseif (($html->find('img[class=ship-portrait-frame-img]'))) {
                $tname = $html->children(0)->children(1)->children(0)->alt;
                //echo htmlspecialchars($html->children(0)->children(1)->children(0)->alt) . '<br><br>';
            }
            return cleanShipNames($tname);
            //return $tname;
        }

        function getShipLevel($html){
            //echo htmlspecialchars($html);
            $level = 0;
            if ($html !== NULL && ($html->find('div[class=ship-portrait-full-frame-level]'))) {
                $level = $html->children(2)->plaintext;
            }
            return $level;
        }

        function getShipStars($html){
            $stars = 0;
            //echo htmlspecialchars($html);
            //echo '<br>' . strlen((string)$html->children(0));
            if (strlen((string)$html->children(0)) == 43) {$stars++;}
            if (strlen((string)$html->children(1)) == 43) {$stars++;}
            if (strlen((string)$html->children(2)) == 43) {$stars++;}
            if (strlen((string)$html->children(3)) == 43) {$stars++;}
            if (strlen((string)$html->children(4)) == 43) {$stars++;}
            if (strlen((string)$html->children(5)) == 43) {$stars++;}
            if (strlen((string)$html->children(6)) == 43) {$stars++;}

            return $stars;
        }
        
        function cleanShipNames($name){
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