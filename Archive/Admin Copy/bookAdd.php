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
		<label>Shelf No:</label><input type = "text" name = "ShelfNo" value = ""><br>
		<br><label>First Book:</label><input type = "text" name = "First" value = ""><br>
		<br><label>Last Book:</label><input type = "text" name = "Last" value = ""><br>
		<br><label>Map:</label><input type = "text" name = "Map" value = ""><br>
		<br><input type = "submit" name = "submit" value = "Submit">
		</form>
	</div>
	

<?php
	include ("connect.php");
	// if submit button is pressed, process inputs 
	if (isset($_POST['submit']))
	{
		// store inputs in variables
		$ShelfNo = $conn->real_escape_string($_POST['ShelfNo']);
		$First = $conn->real_escape_string($_POST['First']);
		$Last = $conn->real_escape_string($_POST['Last']);
		$Map = $conn->real_escape_string($_POST['Map']);
		//check that all fields are filled
		if (($ShelfNo || $First || $Last || $Map) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			//add to database
			if ($stmt = $conn->prepare("INSERT INTO BookLocations1 (ShelfNo, First, Last, Map) VALUES (?,?,?,?)"))
			{
				$stmt->bind_param("isss",$ShelfNo,$First,$Last,$Map);
				$stmt->execute();
				$stmt->close();
				header("Location: bookLoc1.php");			
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