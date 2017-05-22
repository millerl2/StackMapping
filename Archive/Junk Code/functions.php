<?php 
	$callNumber = $_GET["callNumber"];
	$shelfNum = searchBooks($callNumber);
	$shelfLoc = getShelfLoc($shelfNum);

	
	// Return shelf number where book with call num is located
	function searchBooks($data){
		$shelfNum = "";
		$mapNum = "";
		$callNum = $data;
		//echo "In searchBooks function....\n";
		connectDB();
		$query = "SELECT * FROM BookLocations1";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		while($row = mysql_fetch_array($result)){
			if(strnatcmp($callNum, $row['First']) >= 0 && strnatcmp($callNum, $row['Last']) <= 0){
				//getting every shelfNum, possibly because strings are different lengths and cannot compare
				$shelfNum = $row['ShelfNo'];
				$mapNum = $row['Map'];
				//echo "Map type: ".gettype($mapNum);
				//add positive feedback
				$found = 1;
				break;
			}
			else{
				$found = 0;
			}
		}
		//echo "found: ".$found;
		postFeedback($callNum, $shelfNum, $found);
		//echo $shelfNum.' ';
		
		//echo "Time to get modified shelf number....\n";
		//only works for concourse call numbers
		$mapInt = intval($mapNum)+1;
		$modShelfNum  = $mapInt.$shelfNum;
		
		//echo "ModShelfNum: ".$modShelfNum."\n";
		return $modShelfNum;
	}
	
	function getShelfLoc($data){
		//echo "In getShelfLoc funtion....\n";
		$shelfNum = $data;
		
		connectDB();
		
		$query = "SELECT * FROM ShelfLocations WHERE ShelfNo = '$shelfNum'";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		$row = mysql_fetch_array($result);
		$outArray = array();
		
		$outArray['ShelfNo'] = $row['ShelfNo'];
		$outArray['X'] = $row['X'];
		$outArray['Y'] = $row['Y'];
		$outArray['Width'] = $row['Width'];
		$outArray['Height'] = $row['Height'];
		$outArray['Map'] = $row['Map'];
		header('Content-Type: application/json');		
		echo json_encode($outArray);
	}
	
	function getAllShelfLoc($data){
		connectDB();
		$query = "SELECT * FROM ShelfLocations";
		$result = mysql_query($query);
		$outArray = array();
		if($result){
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$row_array['ShelfNo'] = $row['ShelfNo'];
				$row_array['X'] = $row['X'];
				$row_array['Y'] = $row['Y'];
				$row_array['Width'] = $row['Width'];
				$row_array['Height'] = $row['Height'];
				$row_array['Map'] = $row['Map'];
				
				array_push($outArray, $row_array);
			}
		}
		echo json_encode($outArray);
	}
	
	
	function connectDB(){
		$db_server = mysql_connect('localhost', 'millerl2','16idxh');
		if(!$db_server) die("Unable to connect to MYSQL: ".mysql_error());
		$db = mysql_select_db("millerl2_db", $db_server) or die($result."<br/><br/>".mysql_error());
	}

	function postFeedback($cn, $sn, $fb){
		//echo "In Feedback function.... \n";
		date_default_timezone_set('America/New_York');
		$datetime = date("Y-m-d H:i:s");
		//echo $datetime;
		
		connectDB();
		
		$query = "INSERT INTO FeedBack (CallNo, Found, Time) VALUES('$cn','intval($fb)','$datetime')";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		mysql_close();
	}
?>