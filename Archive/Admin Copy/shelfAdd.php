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
		<br><label>X:</label><input type = "text" name = "X" value = ""><br>
		<br><label>Y:</label><input type = "text" name = "Y" value = ""><br>
		<br><label>Width:</label><input type = "text" name = "Width" value = ""><br>
		<br><label>Height:</label><input type = "text" name = "Height" value = ""><br>
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
		$X = $conn->real_escape_string($_POST['X']);
		$Y = $conn->real_escape_string($_POST['Y']);
		$Width = $conn->real_escape_string($_POST['Width']);
		$Height = $conn->real_escape_string($_POST['Height']);
		$Map = $conn->real_escape_string($_POST['Map']);
		//check that all fields are filled
		if (($ShelfNo || $X || $Y || $Width || $Height || $Map) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			//add to database
			if ($stmt = $conn->prepare("INSERT INTO ShelfLocations (ShelfNo, X, Y, Width, Height, Map) VALUES (?,?,?,?,?,?)"))
			{
				$stmt->bind_param("issssi",$ShelfNo,$X,$Y,$Width,$Height,$Map);
				$stmt->execute();
				$stmt->close();
				header("Location: shelfLoc1.php");			
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