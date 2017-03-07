<!DOCTYPE html>
<html lang = "en">
	<head>
	<meta charset = UTF-8">
	<link rel = "stylesheet" href = "admin.css">
	</head>
	
	<body>
	<div id = "container">
		<h1> Add Entry </h1>
		<form action = "" method = "post">
		<label>CallNo:</label><input type = "text" name = "CallNo" value = ""><br>
		<br><label>ShelfNo:</label><input type = "integer" name = "ShelfNo" value = ""><br>
		<br><label>Found:</label><input type = "integer" name = "Found" value = ""><br>
		<br><label>Time:</label><input type = "datetime" name = "Time" value = ""><br>
		<br><input type = "submit" name = "submit" value = "Submit">
		</form>
	</div>
	

<?php
	include ("connect.php");
	// if submit button is pressed, process inputs 
	if (isset($_POST['submit']))
	{
		// store inputs in variables
		$CallNo = $conn->real_escape_string($_POST['CallNo']);
		$ShelfNo = $conn->real_escape_string($_POST['ShelfNo']);
		$Found = $conn->real_escape_string($_POST['Found']);
		$Time = $conn->real_escape_string($_POST['Time']);
		//check that all fields are filled
		if (($ShelfNo || $First || $Last || $Map) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			//add to database
			if ($stmt = $conn->prepare("INSERT INTO FeedBack (CallNo, ShelfNo, Found, Time) VALUES (?,?,?,?)"))
			{
				$stmt->bind_param("isss",$CallNo,$ShelfNo,$Found,$Time);
				$stmt->execute();
				$stmt->close();
				header("Location: feedback.php");			
			}
			else
			{
				echo "Error: Unable to complete add request.";
			}
		}
	}
	$conn->close();
?>
	</body>
</html>