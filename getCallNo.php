

<?php
$url = 'http://library.newpaltz.edu/xaleph/?sys=000651842';

$lines = file($url);
$search = 'callno';
$found = "";
foreach ($lines as $line) {
   if(strpos($line,$search) !== false)
   $found = $line;
}

//echo $found;

$myArray = explode(':', $found);
$myArray = str_replace('"', "", $myArray);
$myArray=str_replace(',', "", $myArray);
print_r($myArray[1]);


?>
