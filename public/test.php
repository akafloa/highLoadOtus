<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$file = file_get_contents('./input.txt');



function sumMy($n){
    echo $n;
    $nn = explode(' ', $n);
    
    return $nn[0] + $nn[1];
}

$res = sumMy($file);
//echo $res;




$fd = fopen("./output.txt", 'w');

var_dump($fd);

fwrite($fd, $res);
fclose($fd);

$text = file_get_contents("./output.txt");

var_dump($text);

