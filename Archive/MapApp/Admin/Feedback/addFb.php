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
			echo "Feedback successfully submitted! <br><br>";
		}
	}	
?>
	<form action = "" method = "post">
		<label for = "redirect">Would you like to search for another call number?</label><br>
		<input type = "radio" name = "redirect" value = "yes" checked> Yes <br>
		<input type = "radio" name = "redirect" value = "no"> No <br>
		<input type = "submit" name = "submit" value = "Submit">	
	</form>

<?php		
	if (isset($_POST['submit']))
	{
		$redirect = $_POST['redirect'];
		if ($redirect == 'yes')
		{
			header ("Location: ../../index.html");
		}
		else 
		{
			header ("Location: https://library.newpaltz.edu/");
		}
	}	
?>

