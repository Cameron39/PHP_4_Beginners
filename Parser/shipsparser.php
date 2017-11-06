<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Ships Parser</title>
    </head>
    <body>

        <?php

        include "getGuild.php";
        
        ini_set('max_execution_time', 300); //5 minutes.
            
        $urls = array();
        $charAll = array();
        $master = array();
        $c = ",";
        $t = "&emsp;";
        $q = "','";
        $d = '<td>';
        $e = '</td>';
        $servername = 'localhost';
        //$username = 'root';
        //$password = 'droid4swgoh';
        $count = 1;
        $ttl_cnt=0;

        $urls = getUserUrls();


        $ttl_cnt = count($urls);
        echo '<table>';
        echo '<tr>';
        echo '<th>User</th>';
        echo '<th>Ship</th>';
        echo '<th>Stars</th>';
        echo '<th>Level</th>';
        echo '<th>Gear</th>';
        echo '<tr>';
        
        $url = 'https://swgoh.gg/u/darkness39/ships/';
        $html = file_get_html($url);
        $Mitems = $html->find('li[class=media list-group-item p-a collection-char-list]');
        $items = $Mitems[0]->find('div[class=row]');
        //echo $items[0]->children(0);
        //echo $items[0];
        
        $temp = $Mitems[0]->children(0)->children(0)->children(0)->children(0)->children(0)->children(0);
        //echo htmlspecialchars($temp);
        $name = getName($Mitems[0]->children(0)->children(0)->children(0)->children(0)->children(0)->children(0));
        echo '<br>-' . $name . '-<br>';
        
        //possible start: <li class="media list-group-item p-a collection-char-list">
        
        
        exit();
        
        
        foreach ($urls as $user => $profile) {

            $url = 'https://swgoh.gg' . $profile . 'ships/';
            //echo $url . '<br>';
            sleep(0.1);
            $html = file_get_html($url);

            $items = $html->find('div[class=col-xs-6 col-sm-3 col-md-3 col-lg-2]');

            foreach ($items as $item){
                $name = getName($item->children(0)->children(0)->children(0));//->children(0));
                $level = getLevel($item->children(0)->children(0)->children(0));
                $gear = getGear($item->children(0)->children(0)->children(0));//->children(10));
                $stars = getStars($item->children(0)->children(0)->children(0));
                //echo $name . $t . $stars . $t . $level . $t . $gear . $t . $valid . "<br>";
                echo '<tr>';
                echo $d . $user . $e;
                echo $d . $name . $e;
                echo $d . $stars . $e;
                echo $d . $level . $e;
                echo $d . $gear . $e;
                echo '</tr>';
                
            }

            //echo '(' . $count . '/'. $ttl_cnt . ') User: ' . $user . ' -> done<br>';
            ob_flush();
            flush();
            $count++;
            //sleep(1);
            //echo "<br><br>";
        }
        echo '</table>';


        function getName($html){

            echo htmlspecialchars($html) . "<br>";
            $tname = 'NA';
            if (($html->find('img[class=ship-portrait-full-frame-img]'))) {
                $found = $html->find('img[class=ship-portrait-full-frame-img]');
                $tname = $found[0]->alt;
                //echo 'name:';
                //echo htmlspecialchars($found[0]);
            }
            //elseif (($html->find('img[class=ship-portrait-img]'))) {
            //    $tname = $html->children(0)->children(0)->alt;
            //    //echo htmlspecialchars($html->children(0)->children(0)->alt);
            //}
            //else {
            //    $tname = 'NA';
            //}
            //echo htmlspecialchars($html);
            //$name = str_replace('&quot;',' ', $name); //seems to slow it down?
            //$name = str_replace('&#39;',' ', $name);
            //return cleanNames($tname);
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
        
        function cleanNames($name){
            $badChar1 = array(chr(145), chr(146), chr(147), chr(148),'&quot;');
            $badChar2 = array('&#39;');
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