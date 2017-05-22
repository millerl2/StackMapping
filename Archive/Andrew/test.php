<?php

include('functions.php');

//get callnumber from textbox
$callnumber = $_GET['callNumber']
echo $callnumber

//get shelf number from the BooksLocations1 db
$shelfNum = searchBooks($callnumber);
echo "This is the returned shelfnum: ".$shelfNum."\n";

//get shelf location array from the ShelfLocations db
$shelfLoc = getShelfLoc($shelfNum);

//get rect coords from the shelfLoc array
$rectCoords = getRectCoords($shelfLoc);

/*
echo "This is the returned rectCoords: ".$rectCoords['X']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Y']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Width']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Height']."\n";
echo "This is the returned rectCoords: ".$rectCoords['Map']."\n";
*/

//$map = $rectCoords['Map'];

//try displaying the different maps, but not working.
/*
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
*/


?>