<? 
     
	 
	# Return shelf number where book with call num is located
	function searchBooks($data){
		$shelfNum = "";
		$callNum = $data;
		echo "In searchBooks function....";
		$db_server = mysql_connect('localhost', 'millerl2', '16idxh');
		if(!$db_server) die("Unable to connect to MYSQL: ".mysql_error());
		$db = mysql_select_db('millerl2_db', $db_server) or die($result."<br/><br/>".mysql_error());
		$query = "SELECT * FROM BookLocations1";
		$result = mysql_query($query) or die($result."<br/><br/>".mysql_error());
		while($row = mysql_fetch_array($result)){
			if(strcmp($callNum, $row['First']) >= 0 && strcmp($callNum, $row['Last']) <= 0){
				//getting every shelfNum, possibly because strings are different lengths and cannot compare
				$shelfNum = $row['ShelfNo'];
				echo $shelfNum.' ';
				//add positive feedback
			}			
			else{
			//add negative feedback
			//echo 'NOT FOUND ';
			}
		}
		mysql_close();
		return $shelfNum;
	}


?>