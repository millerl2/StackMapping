<?php
	include ("connect.php");
	function showData($ShelfNo = '', $X ='', $Y = '', $Length = '', $Width = '', $Map = '')
	{ 
?>
		<!DOCTYPE html> 
		<html lang = "en">
		<head>
		<meta charset = UTF-8">
		<link rel = "stylesheet" href = "admin.css">
		</head>
	
		<body>
		<div id = "container">
			<h1> Edit Record </h1>
			<form action = "" method = "post">
			<label>Shelf No:</label><input type = "text" name = "ShelfNo" value = "<?php echo $ShelfNo; ?>" readonly><br>
			<br><label>X:</label><input type = "text" name = "First" value = "<?php echo $X; ?>"><br>
			<br><label>Y:</label><input type = "text" name = "Last" value = "<?php echo $Y; ?>"><br>
			<br><label>Length:</label><input type = "text" name = "Map" value = "<?php echo $Length; ?>"><br>
			<br><label>Width:</label><input type = "text" name = "First" value = "<?php echo $Width; ?>"><br>
			<br><label>Map:</label><input type = "text" name = "Last" value = "<?php echo $Map; ?>"><br>
			<br><input type = "submit" name = "submit" value = "Submit">
			</form>
		</div>
<?php 
	}
	// if submit is pressed, submit the form with updated data
	if (isset($_POST['submit']))
	{
		$ShelfNo = $_GET['ShelfNo'];
		$X = $conn->real_escape_string($_POST['X']);
		$Y = $conn->real_escape_string($_POST['Y']);
		$Length = $conn->real_escape_string($_POST['Length']);
		$Width = $conn->real_escape_string($_POST['Width']);
		$Map = $conn->real_escape_string($_POST['Map']);
		//check that all fields are filled
		if (($ShelfNo || $X || $Y || $Length || $Width || $Map) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			if ($stmt = $conn->prepare("UPDATE ShelfLocations1 SET X = ?, Y = ?, Length = ?, Width = ?, Map = ? WHERE ShelfNo = $ShelfNo"))
			{
				$stmt->bind_param("sssss",$X,$Y,$Length,$Width,$Map);
				$stmt->execute();
				$stmt->close();
				header("Location: shelfLoc1.php");
			}
			else
			{
				echo "Error: Unable to complete edit request.";
			}
		}
	}
	// else if submit button is not pressed, show form with current data 
	else
	{
		$ShelfNo = $_GET['ShelfNo'];
		if ($stmt = $conn->prepare("SELECT * FROM ShelfLocations1 WHERE ShelfNo = ?"))
		{
			$stmt->bind_param("i",$ShelfNo);
			$stmt->execute();
			$stmt->bind_result($ShelfNo,$X,$Y,$Length,$Width,$Map);
			$data = $stmt->fetch();
			$stmt->close();
		}
		showData($ShelfNo,$X,$Y,$Length,$Width,$Map);
	}	
	$conn->close();
?>	
	</body>
</html>