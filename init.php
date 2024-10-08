<?php
$tab = file("./articles.csv");
foreach($tab as $keyTab => $valueTab){
    $tab[$keyTab] = explode(',',trim($valueTab));
    $temp = $tab[$keyTab];
    // var_dump($temp[1]);
    $articles[$temp[0]] = array(0 => $temp[1], 1 => $temp[2], 2 => $temp[3], 3 => 0, 4 =>0);
}

print_r($articles);
$ser = serialize($articles);
file_put_contents("./data",$ser);
?>