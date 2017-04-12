<?php

include('functions.php');

echo $_GET['callNumber']."\n";
$shelfNum = searchBooks($_GET['callNumber']);
echo "This is the returned shelfnum: ".$shelfNum."\n";
$shelfLoc = getShelfLoc($shelfNum);
$rectCoords = getRectCoords($shelfLoc);
/*
echo "This is the returned rectCoords: ".$rectCoords['X']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Y']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Width']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Height']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Map']."\n";
*/
$map = $rectCoords['Map'];
//echo gettype($map);
//echo "This the map for the rect: ".$map;
switch($map){
	case '0':
		echo '<script type="text/javascript" src="AppMap new.html">', 'showMain();','</script>';
		break;
	case '1':
		echo '<script type="text/javascript" src="AppMap new.html">','showConcourse();','</script>';
		break;
	case '2':
		echo '<script type="text/javascript" src="AppMap new.html">','showGround();','</script>';
		break;
}



?>