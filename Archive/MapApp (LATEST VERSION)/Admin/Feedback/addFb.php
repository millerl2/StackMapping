<?php
	include ("../connect.php");
	date_default_timezone_set("America/New_York");
	// if submit button is pressed, process inputs 
	if (isset($_POST['fbSubmit']))
	{
		$callNo = $conn->real_escape_string($_POST['callno']);
		$found = $conn->real_escape_string($_POST['found']);
		if ($found == 'yes')
		{
			$found = 1;
		}
		else 
		{
			$found = 0;
		}
		$datetime = date('Y-m-d H:i:s');
		
		$query = "INSERT INTO FeedBack (CallNo, Found, Time) VALUES ('".$callNo."','".$found."','".$datetime."')";
		if ($conn->query($query) === TRUE)
		{
			$message = "Feedback successfully submitted! ";
			echo "<script type='text/javascript'>alert('$message'); window.location = '../../index.html';</script>";
		}
	}	
?>
