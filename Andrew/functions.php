<? 
     
	 
	# Return shelf number where book with call num is located
	function searchBooks($data){
		$shelfNum = "";
		$mapNum = "";
		$callNum = $data;
		$found = 0;
		echo "In searchBooks function....\n";
		connectDB();
		$query = "SELECT * FROM BookLocations1";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		while($row = mysql_fetch_array($result)){
			if(strcmp($callNum, $row['First']) >= 0 && strcmp($callNum, $row['Last']) <= 0){
				//getting every shelfNum, possibly because strings are different lengths and cannot compare
				$shelfNum = $row['ShelfNo'];
				$mapNum = $row['Map'];
				//echo "Map type: ".gettype($mapNum);
				//add positive feedback
				$found = 1;
			}			
			else{
			//add negative feedback
			//echo 'NOT FOUND ';
			$found = 0;
			}
		}
		postFeedback($callNum, $shelfNum, $found);
		//echo $shelfNum.' ';
		
		echo "Time to get modified shelf number....\n";
		//only works for concourse call numbers
		$mapInt = intval($mapNum)+1;
		$modShelfNum  = $mapInt.$shelfNum;
		
		echo "ModShelfNum: ".$modShelfNum."\n";
		mysql_close();
		return $modShelfNum;
	}
	
	function getShelfLoc($data){
		echo "In getShelfLoc funtion....\n";
		$shelfNum = $data;
		
		connectDB();
		
		$query = "SELECT * FROM ShelfLocations WHERE ShelfNo = ".strval($shelfNum);
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	function getRectCoords($dataArray){
		echo "In getRectCoords function.... \n";
		$data = $dataArray;
		
		$xCoor = floatval($data['X']);
		$yCoor = floatval($data['Y']);
		$width = floatval($data['Width']);
		$height = floatval($data['Height']);
		$map = intval($data['Map']);
		
				
		//echo "$shelfNum: ".gettype($shelfNum)." $xCoor: ".gettype($xCoor)." $yCoor: ".gettype($yCoor)." $width: ".gettype($width)." $height: ".gettype($height)." $map: ".gettype($map)."\n";
		//echo "shelfNum: ".$shelfNum." xCoor: ".$xCoor." yCoor: ".$yCoor." width: ".$width." height: ".$height." map: ".$map;
		//echo $shelfNum."\n";
		//echo $xCoor."\n";
		//echo $yCoor."\n";
		//echo $width."\n";
		//echo $height."\n";
		//echo $map;
		
		//show target rect
		//showRect($xCoor, $yCoor, $width, $height);
		return $dataArray;
	}
	
	function connectDB(){
		$db_server = mysql_connect('localhost', 'millerl2','16idxh');
		if(!$db_server) die("Unable to connect to MYSQL: ".mysql_error());
		$db = mysql_select_db("millerl2_db", $db_server) or die($result."<br/><br/>".mysql_error());
	}

	function postFeedback($cn, $sn, $fb){
		echo "In Feedback function.... \n";
		date_default_timezone_set('America/New_York');
		$datetime = date("Y-m-d H:i:s");
		//echo $datetime;
		
		connectDB();
		
		$query = "INSERT INTO FeedBack (CallNo, Found, Time) VALUES('$cn','intval($fb)','$datetime')";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
	}
?>